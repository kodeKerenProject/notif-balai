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
use App\User;
use App\Produk;
use App\TahapSert;

class JAController extends Controller
{
    public function index($id, $idProduk) {
        $user = User::find($id);
        $produk = Produk::where('id', $idProduk)->first();
        if (is_null($user) || is_null($produk)) {
            return redirect()->back();
        }
        $laporanAudit = LaporanAudit::where('produk_id', $idProduk)->first();
        $jadwalAudit = !is_null($laporanAudit) ? $laporanAudit->jadwal_audit()->first() : null;
        $dok = BidPrice::where('produk_id', $idProduk)->first();

        return view('audit.audit', [ 'user' => $user, 'produk' => $produk, 'idProduk' => $idProduk, 'user_id' => $id, 'jadwalAudit' => $jadwalAudit, 'dok' => $dok]);
    }

    public function upload(Request $request, $idProduk) {
        // validasi extensi file upload
        // php.ini
        // post_max_size => ukuran maksimum file yang dapat dihandle oleh php
        // upload_max_filesize => ukuran maksimum file untuk diupload ke server
        $d = \Validator::make($request->file(), [
            'dok' => 'required|max:2000|mimes:pdf',
        ],[
            'max'    => 'Ukuran tidak boleh melebihi 2 megabytes',
            'mimes'      => 'Extensi file harus pdf',
        ]);
        if ($d->fails()) {return redirect()->back()->withErrors($d);}

    	$file = $request->dok;
        $fileName = 'Surat_Pemberitahuan_Jadwal_Audit-'.uniqid().''.date('YmdHis').'.pdf';
    	$file->storeAs('dok/jadwalAudit', $fileName);

    	$dok = new JadwalAudit;
    	$dok->jadwal_audit = $fileName;
        $dok->doc_maker = \Auth::user()->id;
    	$dok->save();

    	$la = new LaporanAudit;
        $la->produk_id = $idProduk;
    	$la->jadwal_audit_id = $dok->id;
    	$la->save();

        $tahap = TahapSert::where('produk_id', $la->produk_id)->first();
        $tahap->jadwal_audit = 1;
        $tahap->save();

    	return redirect()->back();
    }

    public function getDokSert($id, $idProduk) {
        $user = User::find($id);
        $produk = Produk::where('id', $idProduk)->first();
        if (is_null($user) || is_null($produk)) {
            return redirect()->back();
        }
        $laporanAudit = LaporanAudit::where('produk_id', $idProduk)->first();
        $dokImportir = !is_null($laporanAudit) ? $laporanAudit->dokImportir() : null;
        $dokManufaktur = !is_null($laporanAudit) ? $laporanAudit->dokManufaktur() : null;
        $tinjauanPP = !is_null($laporanAudit) ? $laporanAudit->tinjauanPP() : null;
        return view('audit.dokSert', ['laporanAudit' => $laporanAudit, 'dokImportir' => $dokImportir, 'dokManufaktur' => $dokManufaktur, 'tinjauanPP' => $tinjauanPP, 'user' => $user, 'produk' => $produk, 'idProduk' => $idProduk, 'user_id' => $id]);
    }

    public function dok_sert_produk(Request $request) {
        $laModel = new LaporanAudit;
        $laDB = $laModel->where('produk_id', $request->idProduk)->first();
        // filter dok sesuai tabel DB
    	$arr = $laModel->cekDokSert_arr($request);

        // update kolom auditor
        if (is_null($laDB->auditor)) {
            $auditor = $laDB;
            $auditor->auditor = \Auth::user()->id;
            $auditor->save();
        }

        $kelengkapanDocDN = 1;
		foreach ($arr as $key => $value) {
            // ambil data dari setiap table di array 'arr'
			$table = $laModel->getTableAudit($value[0], $key, $laDB);

            // hapus dok jika dinyatakan tidak lengkap
            $review = !is_null($table) && !is_null($table->getReview()) ? $table->getReview() : $value[2];
            for ($i=5; $i < count($value); $i++) {
                $field = $value[$i][0];
				if ($value[$i][1] == 'null' && !is_null($table) && !is_null($table->$field)) {
                    \Storage::delete('dok/'.$value[1].'/'.$table->$field);
					$table->$field = null;
				}
				if (!is_null($value[$i][2])) {$review->$field = $value[$i][2];}
			}

            // cek kelengkapan semua dok
            for ($i=5; $i < count($value); $i++) {
                // jika dok belum lengkap
                if ($value[$i][1] == 'null') {
                    $kelengkapanDocDN = 0;
                    $table->lengkap = 2;
                    goto save;
                }
            }
            // jika dok sudah lengkap
            if ($kelengkapanDocDN == 1) {
                $table->lengkap = 1;
                $tahap = TahapSert::where('produk_id', $request->idProduk)->first();
                $tahap->dokSert = 1;
                $tahap->save();
            }

            save: {
                $review->save();
                $foreignkey = $value[3];
                $table->$foreignkey = $review->id;
                $table->save();

                $laForeignKey = $value[4];
                $laDB->$laForeignKey = $table->id;
            }
		}
        $laDB->save();

    	return redirect()->back()->with('successMsg', 'Form berhasil diisi, tunnggu kelengkapan dokumen dari client');
    }


    public function verify_dokSert() {
        $laporanAudit = LaporanAudit::where('produk_id', \Auth::user()->id_produk())->first();
        $dokImportir = !is_null($laporanAudit) ? $laporanAudit->dokImportir() : null;
        $dokManufaktur = !is_null($laporanAudit) ? $laporanAudit->dokManufaktur() : null;
        $tinjauanPP = !is_null($laporanAudit) ? $laporanAudit->tinjauanPP() : null;
        return view('audit.kelengkapanAudit', ['laporanAudit' => $laporanAudit, 'dokImportir' => $dokImportir, 'dokManufaktur' => $dokManufaktur, 'tinjauanPP' => $tinjauanPP]);
    }

    public function dokAudit(Request $request) {
        $laModel = new LaporanAudit;
        $laDB = $laModel->where('produk_id', \Auth::user()->id_produk())->first();
        // filter dok sesuai tabel DB
        $arr = $laModel->dokAudit($request);

        $fn = [];
        $idTable = [];
        foreach ($arr as $key => $value) {
            // ambil data dari setiap table di array 'arr'
            $table = $laModel->getTableAudit($value[0], $key, $laDB);

            // upload dok
            for ($i=2; $i<count($value); $i++) {
                if (isset($value[$i][1])) {
                    array_push($fn, uniqid().'-'.date('YmdHis').'.'.$value[$i][1]->extension());
                    $value[$i][1]->storeAs('dok/'.$value[1], $fn[count($fn)-1]);
                    $field = $value[$i][0];
                    $table->$field = $fn[count($fn)-1];
                }
            }
            $table->lengkap = 3;
            $table->save();
            array_push($idTable, $table->id);
        }
        $laDB->dok_importir_id = $idTable[0];
        $laDB->dok_manufaktur_id = $idTable[1];
        $laDB->tinjauan_pp_id = $idTable[2];
        $laDB->save();

        return redirect()->back();
    }

    public function auditPlan($id, $idProduk) {
        $user = User::find($id);
        $produk = Produk::where('id', $idProduk)->first();
        if (is_null($user) || is_null($produk)) {
            return redirect()->back();
        }
        $laporanAudit = LaporanAudit::where('produk_id', $idProduk)->first();
        $dokImportir = !is_null($laporanAudit) ? $laporanAudit->dokImportir() : null;
        $dokManufaktur = !is_null($laporanAudit) ? $laporanAudit->dokManufaktur() : null;
        $tinjauanPP = !is_null($laporanAudit) ? $laporanAudit->tinjauanPP() : null;
        $asPlan = AuditSamplingPlan::where('produk_id', $idProduk)->first();

        return view('audit.audit_samplingPlan', ['user' => $user, 'produk' => $produk, 'idProduk' => $idProduk, 'user_id' => $id, 'dokImportir' => $dokImportir, 'dokManufaktur' => $dokManufaktur, 'tinjauanPP' => $tinjauanPP, 'asPlan' => $asPlan]);
    }

    public function auditPlan_upload(Request $request, $idProduk) {
        $fileName1 = 'AuditPlan-'.uniqid().'.'.$request->auditPlan->extension();
        $fileName2 = 'SamplingPlan-'.uniqid().'.'.$request->samplingPlan->extension();
        $request->auditPlan->storeAs('dok/auditPlan', $fileName1);
        $request->samplingPlan->storeAs('dok/samplingPlan', $fileName2);
        
        $asPlan = new AuditSamplingPlan;
        $asPlan->produk_id = $idProduk;
        $asPlan->doc_maker = \Auth::user()->id;
        $asPlan->audit_plan = $fileName1;
        $asPlan->sampling_plan = $fileName2;
        $asPlan->save();

        $tahap = TahapSert::where('produk_id', $idProduk)->first();
        $tahap->sampling_plan = 1;
        $tahap->save();

        return redirect()->back();
    }

    public function apprv_jadwalAudit($id, $idProduk) {
        $user = User::find($id);
        $produk = Produk::where('id', $idProduk)->first();
        if (is_null($user) || is_null($produk)) {
            return redirect()->back();
        }
        $laporanAudit = LaporanAudit::where('produk_id', $idProduk)->first();
        $jadwalAudit = !is_null($laporanAudit) ? $laporanAudit->jadwal_audit()->first() : null;

        return view('audit.apprv_jadwal', [ 'user' => $user, 'produk' => $produk, 'idProduk' => $idProduk, 'user_id' => $id, 'jadwalAudit' => $jadwalAudit]);
    }

    public function apprvPost(Request $request) {
        $laporanAudit = LaporanAudit::where('produk_id', $request->produkId)->first();
        $la = $laporanAudit->jadwal_audit()->first();
        if ($request->choice == '1') {
            $la->apprv = 1;
            $la->save();
        } else {
            $la->delete();
        }

        return redirect()->back();
    }
}