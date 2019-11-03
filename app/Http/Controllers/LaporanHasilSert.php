<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LaporanSert;
use App\User;
use App\Produk;
use App\TahapSert;
use App\AuditSamplingPlan;
use Illuminate\Support\Arr;

class LaporanHasilSert extends Controller
{
    public function index($id, $idProduk) {
    	$user = User::find($id);
        $produk = Produk::where('id', $idProduk)->first();
        if (is_null($user) || is_null($produk)) {
            return redirect()->back();
        }
        $samplingPlan = AuditSamplingPlan::where('produk_id', $idProduk)->first();
        $dok = LaporanSert::where('produk_id', $idProduk)->first();
    	return view('lapSert.lapSert', ['user' => $user, 'produk' => $produk, 'idProduk' => $idProduk, 'user_id' => $id, 'dok' => $dok, 'samplingPlan' => $samplingPlan]);
    }

    public function upload(Request $request, $idProduk) {
    	$dok1 = 'SHU-'.uniqid().'.'.$request->shu->extension();
    	$dok2 = 'BAPC-'.uniqid().'.'.$request->bapc->extension();
    	$dok3 = 'Closed_NCR-'.uniqid().'.'.$request->cncr->extension();

    	$request->shu->storeAs('dok/shu', $dok1);
    	$request->bapc->storeAs('dok/bapc', $dok2);
    	$request->cncr->storeAs('dok/closedNCR', $dok3);

    	$dok = new LaporanSert;
        $dok->produk_id = $idProduk;
    	$dok->shu = $dok1;
    	$dok->bapc = $dok2;
    	$dok->closed_ncr = $dok3;
        $dok->doc_maker = \Auth::user()->id;
    	$dok->save();

    	return redirect()->back();
    }

    public function create(Request $request, $idProduk) {
		$dok = LaporanSert::where('produk_id', $idProduk)->first();
		$dok->dok_lapSert = json_encode(Arr::except($request->all(), ['_token']), true);
    	$pdf = \PDF::loadView('dok.lapSertDok', ['nama' => $request->nama, 'produk' => $request->produk]);
    	$output = $pdf->output();
    	$fileName = 'Laporan_Hasil_Sertifikasi-'.uniqid().''.date('YmdHis').'.pdf';
        \Storage::put('dok/lapSert/'.$fileName, $output);

		$dok->laporan_hasil_sert = $fileName;
		$dok->save();

        $tahap = TahapSert::where('produk_id', $idProduk)->first();
        $tahap->lapSert = 1;
        $tahap->save();

		return redirect()->back();
    }

    public function getRekomendasi($id, $idProduk) {
        $user = User::find($id);
        $produk = Produk::where('id', $idProduk)->first();
        if (is_null($user) || is_null($produk)) {
            return redirect()->back();
        }
        $dok = LaporanSert::where('produk_id', $idProduk)->first();
        $input_tt = false;
        if (!is_null($dok) && !is_null($dok->input_tt)) {
            foreach (json_decode($dok->input_tt, true) as $key => $value) {
                if ($value['id'] == \Auth::user()->id) {
                    $input_tt = true;
                }
            }
        }
        return view('lapSert.rekomendasiRapat', ['user' => $user, 'produk' => $produk, 'idProduk' => $idProduk, 'user_id' => $id, 'dok' => $dok, 'input_tt' => $input_tt]);
    }

    public function rekomendasi(Request $request, $idProduk) {
    	$dok = LaporanSert::where('produk_id', $idProduk)->first();
    	$data = json_decode($dok->dok_lapSert, true);
    	if (!is_null($dok->input_tt)) {
    		$rek = json_decode($dok->input_tt, true);
    		array_push($rek, ["id"=>\Auth::user()->id,"nama"=>\Auth::user()->name,"rekomendasi"=>$request->rek]);
            $rekDB = json_encode($rek);
    	} else {
    		$rekDB = json_encode([["id"=>\Auth::user()->id,"nama"=>\Auth::user()->name,"rekomendasi"=>$request->rek]]);
    	}
    	$dok->input_tt = $rekDB;

    	$pdf = \PDF::loadView('dok.lapSertDok', ['nama' => $data['nama'], 'produk' => $data['produk'], 'rekomendasi' => $rekDB ]);
    	$output = $pdf->output();
    	$fileName = 'Laporan_Hasil_Sertifikasi-'.uniqid().''.date('YmdHis').'.pdf';

    	if (\Storage::exists('dok/lapSert/'.$dok->laporan_hasil_sert)) {
            \Storage::delete('dok/lapSert/'.$dok->laporan_hasil_sert);
        }
        \Storage::put('dok/lapSert/'.$fileName, $output);

		$dok->laporan_hasil_sert = $fileName;
		$dok->save();

		return redirect()->back();
    }

    public function getKeputusan($id, $idProduk) {
        $user = User::find($id);
        $produk = Produk::where('id', $idProduk)->first();
        if (is_null($user) || is_null($produk)) {
            return redirect()->back();
        }
        $dok = LaporanSert::where('produk_id', $idProduk)->first();
        $input_eval_tt = false;
        if (!is_null($dok) && !is_null($dok->input_evaluasi_tt)) {
            foreach (json_decode($dok->input_evaluasi_tt, true) as $key => $value) {
                if ($value['id'] == \Auth::user()->id) {
                    $input_eval_tt = true;
                }
            }
        }
        return view('lapSert.keputusanRapat', ['user' => $user, 'produk' => $produk, 'idProduk' => $idProduk, 'user_id' => $id, 'dok' => $dok, 'input_eval_tt' => $input_eval_tt]);
    }

    public function keputusan(Request $request, $idProduk) {
        $dok = LaporanSert::where('produk_id', $idProduk)->first();
    	$data = json_decode($dok->dok_lapSert, true);
    	$rekDB = $dok->input_tt;
    	if (!is_null($dok->input_evaluasi_tt)) {
    		$kep = json_decode($dok->input_evaluasi_tt, true);
    		array_push($kep, ["id"=>\Auth::user()->id,"nama"=>\Auth::user()->name,"keputusan"=>$request->kep]);
            $kepDB = json_encode($kep);
    	} else {
    		$kepDB = json_encode([["id"=>\Auth::user()->id,"nama"=>\Auth::user()->name,"keputusan"=>$request->kep]]);
    	}
    	$dok->input_evaluasi_tt = $kepDB;

    	$pdf = \PDF::loadView('dok.lapSertDok', ['nama' => $data['nama'], 'produk' => $data['produk'], 'rekomendasi' => $rekDB, 'keputusan' => $kepDB ]);
    	$output = $pdf->output();
    	$fileName = 'Laporan_Hasil_Sertifikasi-'.uniqid().''.date('YmdHis').'.pdf';
        if (\Storage::exists('dok/lapSert/'.$dok->laporan_hasil_sert)) {
            \Storage::delete('dok/lapSert/'.$dok->laporan_hasil_sert);
        }
        \Storage::put('dok/lapSert/'.$fileName, $output);

		$dok->laporan_hasil_sert = $fileName;
		$dok->save();

		return redirect()->back();
    }
}
