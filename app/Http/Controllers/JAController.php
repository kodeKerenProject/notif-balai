<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JadwalAudit;
use App\LaporanAudit;
use App\BidPrice;
use App\DokImportir;
use App\DokManufaktur;
use App\Persyaratan_dalam_negeri;
use App\TinjauanPP;
use App\ReviewDokImportir;
use App\ReviewDokManufaktur;
use App\ReviewTinjauanPP;
use App\AuditSamplingPlan;

class JAController extends Controller
{
    public function index() {
    	return view('audit', ['jadwalAudit' => JadwalAudit::first(), 'laporanAudit' => LaporanAudit::first(), 'dok' => BidPrice::first(), 'dokImportir' => DokImportir::first(), 'dokDalamNegeri' => Persyaratan_dalam_negeri::first(), 'dokManufaktur' => DokManufaktur::first(), 'tinjauanPP' => TinjauanPP::first()]);
    }

    public function upload(Request $request) {
    	$file = $request->dok;
    	$fileName = 'Surat_Pemberitahuan_Jadwal_Audit_'.uniqid().'.pdf';
    	$file->move(public_path().'/dok/jadwalAudit', $fileName);

    	$dok = new JadwalAudit;
    	$dok->jadwal_audit = $fileName;
    	$dok->save();

    	$la = new LaporanAudit;
    	$la->jadwal_audit_id = $dok->id;
    	$la->save();

    	return redirect()->back();
    }

    public function dok_sert_produk(Request $request) {
        
        // filter dok sesuai tabel DB
    	$arr = [[new Persyaratan_dalam_negeri, 'sa', new ReviewDokImportir, 'review_dok_importir_id'],
        [new DokImportir, 'dokImportir', new ReviewDokImportir, 'review_dok_importir_id'],
        [new DokManufaktur, 'dokManufaktur', new ReviewDokManufaktur, 'review_dok_manufaktur_id'],
        [new TinjauanPP, 'tinjauanPP', new ReviewTinjauanPP, 'review_tinjauan_pp_id']];
    	foreach ($request->fileName as $key => $value) {
            if (explode(',', $value)[1] == 'sa') {$index = 0;}
            elseif (explode(',', $value)[1] == 'dokImportir') {$index = 1;}
            elseif (explode(',', $value)[1] == 'dokManufaktur') {$index = 2;}
            else {$index = 3;}
            $review = isset($request->review[$key]) ? $request->review[$key] : null;
            array_push($arr[$index], [explode(',', $value)[0], $request->dok[$key], $review]);
    	}

        $kelengkapanDocDN = 0;
		foreach ($arr as $key => $value) {

            // hapus dok jika dinyatakan tidak lengkap
			$table = !is_null($value[0]->first()) ? $value[0]->first() : $value[0];
            $review = !is_null($value[2]->first()) ? $value[2]->first() : $value[2];
            for ($i=4; $i < count($value) ; $i++) {
                $field = $value[$i][0];
				if ($value[$i][1] == 'null' && !is_null($table) && !is_null($table->$field)) {
					unlink(public_path().'/dok/'.$value[1].'/'.$table->$field);
					$table->$field = null;
				}
				if (!is_null($value[$i][2])) {$review->$field = $value[$i][2];}
			}

            // cek kelengkapan semua dok
            for ($i=4; $i < count($value); $i++) {
                if ($value[$i][1] == 'null' && $key == 0) {$kelengkapanDocDN = 1;}
                if (($value[$i][1] == 'null' && $key != 0) || ($kelengkapanDocDN == 1 && $key == 1)) {$table->lengkap = 2;goto save;}
            }
            if ($kelengkapanDocDN != 1 && $key != 0) {$table->lengkap = 1;}


            save: {
                $review->save();
                $foreignkey = $value[3];
                if ($key != 0) {$table->$foreignkey = $review->id;}
                $table->save();
            }
		}
    	return redirect()->back();
    }


    public function verify_dokSert() {
    	return view('kelengkapanAudit', ['dok' => Persyaratan_dalam_negeri::first(), 'dokImportir' => DokImportir::first(), 'dokManufaktur' => DokManufaktur::first(), 'tinjauanPP' => TinjauanPP::first()]);
    }

    public function dokAudit(Request $request) {

        // filter dok sesuai tabel DB
        $arr = [[new Persyaratan_dalam_negeri, 'sa'],[new DokImportir, 'dokImportir'],
        [new DokManufaktur, 'dokManufaktur'],[new TinjauanPP, 'tinjauanPP']];
        foreach ($request->fileName as $key => $value) {
            if (explode(',', $value)[1] == 'sa') {$index = 0;}
            elseif (explode(',', $value)[1] == 'dokImportir') {$index = 1;}
            elseif (explode(',', $value)[1] == 'dokManufaktur') {$index = 2;}
            else {$index = 3;}
            array_push($arr[$index], [explode(',', $value)[0], $request->dok[$key]]);
        }

        // upload dok
        $fn = [];
        $idTable = [];
        foreach ($arr as $key => $value) {
            $table = !is_null($value[0]->first()) ? $value[0]->first() : $value[0];
            for ($i=2; $i<count($value); $i++) {
                if (isset($value[$i][1])) {
                    array_push($fn, uniqid().'-'.date('YmdHis').'.'.$value[$i][1]->extension());
                    $value[$i][1]->move(public_path().'/dok/'.$value[1], $fn[count($fn)-1]);
                    $field = $value[$i][0];
                    $table->$field = $fn[count($fn)-1];
                }
            }
            if ((isset($arr[0][2]) && $key == 1) || $key != 0) {$table->lengkap = 3;}
            if ($key == 1) {$table->persyaratan_dok_dalam_negeri_id = $arr[0][0]->first()->id;}
            $table->save();

            // push array id tabel dok_importir, dok_manufaktur, tinjauan_pp
            if ($key != 0) {array_push($idTable, $table->id);}
        }

        // update tabel laporan_audit
        $this->update_laporanAudit($idTable);

        return redirect()->back();
    }

    public function update_laporanAudit($arr) {
        $laporanAudit = LaporanAudit::first();
        $laporanAudit->dok_importir_id = $arr[0];
        $laporanAudit->dok_manufaktur_id = $arr[1];
        $laporanAudit->tinjauan_pp_id = $arr[2];
        $laporanAudit->save();
    }

    public function auditPlan_upload(Request $request) {
        $fileName1 = 'AuditPlan-'.uniqid().'.'.$request->auditPlan->extension();
        $fileName2 = 'SamplingPlan-'.uniqid().'.'.$request->samplingPlan->extension();
        $request->auditPlan->move(public_path().'/dok/auditPlan', $fileName1);
        $request->samplingPlan->move(public_path().'/dok/samplingPlan', $fileName2);
        
        $asPlan = new AuditSamplingPlan;
        $asPlan->audit_plan = $fileName1;
        $asPlan->sampling_plan = $fileName2;
        $asPlan->save();

        return redirect()->back();
    }
}