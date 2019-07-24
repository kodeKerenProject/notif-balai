<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LaporanSert;
use Illuminate\Support\Arr;

class LaporanHasilSert extends Controller
{
    public function index() {
    	$dok = LaporanSert::first();
    	$data = [];
    	if (!is_null($dok) && !is_null($dok->input_tt)) {
    		foreach (json_decode($dok->input_tt, true) as $key => $value) {
	    		if ($value['nama'] == 'akjsd') {
	    			$data[0] = true;
	    		}
    		}
    	}
    	if (!is_null($dok) && !is_null($dok->input_evaluasi_tt)) {
    		foreach (json_decode($dok->input_evaluasi_tt, true) as $key => $value) {
	    		if ($value['nama'] == 'akjsd') {
	    			$data[1] = true;
	    		}
    		}
    	}
    	return view('lapSert', compact('dok', 'data'));
    }

    public function upload(Request $request) {
    	$dok1 = 'SHU-'.uniqid().'.'.$request->shu->extension();
    	$dok2 = 'BAPC-'.uniqid().'.'.$request->bapc->extension();
    	$dok3 = 'Closed_NCR-'.uniqid().'.'.$request->cncr->extension();

    	$request->shu->move(public_path().'/dok/shu', $dok1);
    	$request->bapc->move(public_path().'/dok/bapc', $dok2);
    	$request->cncr->move(public_path().'/dok/closedNCR', $dok2);

    	$dok = new LaporanSert;
    	$dok->shu = $dok1;
    	$dok->bapc = $dok2;
    	$dok->closed_ncr = $dok3;
    	$dok->save();

    	return redirect()->back();
    }

    public function create(Request $request) {
		$dok = LaporanSert::first();
		$dok->dok_lapSert = json_encode(Arr::except($request->all(), ['_token']), true);
    	$pdf = \PDF::loadView('lapSertDok', ['nama' => $request['nama'], 'produk' => $request['produk']]);
    	$output = $pdf->output();
    	$fileName = 'Laporan_Hasil_Sertifikasi-'.uniqid().''.date('YmdHis').'.pdf';
		file_put_contents(public_path().'/dok/lapSert/'.$fileName, $output);

		$dok->laporan_hasil_sert = $fileName;
		$dok->save();

		return redirect()->back();
    }

    public function rekomendasi(Request $request) {
    	$dok = LaporanSert::first();
    	$data = json_decode($dok->dok_lapSert, true);
    	if (!is_null($dok->input_tt)) {
    		$rekDB = json_decode($dok->input_tt, true);
    		array_push($rekDB, ["nama"=>"akjsd","rekomendasi"=>$request->rek]);
    	} else {
    		$rekDB = json_encode([["nama"=>"akjsd","rekomendasi"=>$request->rek]]);
    	}
    	$dok->input_tt = $rekDB;

    	$pdf = \PDF::loadView('lapSertDok', ['nama' => $data['nama'], 'produk' => $data['produk'], 'rekomendasi' => $rekDB ]);
    	$output = $pdf->output();
    	$fileName = 'Laporan_Hasil_Sertifikasi-'.uniqid().''.date('YmdHis').'.pdf';
    	if (file_exists(public_path().'/dok/lapSert/'.$dok->laporan_hasil_sert)) {unlink(public_path().'/dok/lapSert/'.$dok->laporan_hasil_sert);}
		file_put_contents(public_path().'/dok/lapSert/'.$fileName, $output);

		$dok->laporan_hasil_sert = $fileName;
		$dok->save();

		return redirect()->back();
    }

    public function keputusan(Request $request) {
    	$dok = LaporanSert::first();
    	$data = json_decode($dok->dok_lapSert, true);
    	$rekDB = $dok->input_tt;
    	if (!is_null($dok->input_evaluasi_tt)) {
    		$kepDB = json_decode($dok->input_evaluasi_tt, true);
    		array_push($kepDB, ["nama"=>"akjsd","keputusan"=>$request->kep]);
    	} else {
    		$kepDB = json_encode([["nama"=>"akjsd","keputusan"=>$request->kep]]);
    	}
    	$dok->input_evaluasi_tt = $rekDB;

    	$pdf = \PDF::loadView('lapSertDok', ['nama' => $data['nama'], 'produk' => $data['produk'], 'rekomendasi' => $rekDB, 'keputusan' => $kepDB ]);
    	$output = $pdf->output();
    	$fileName = 'Laporan_Hasil_Sertifikasi-'.uniqid().''.date('YmdHis').'.pdf';
    	if (file_exists(public_path().'/dok/lapSert/'.$dok->laporan_hasil_sert)) {unlink(public_path().'/dok/lapSert/'.$dok->laporan_hasil_sert);}
		file_put_contents(public_path().'/dok/lapSert/'.$fileName, $output);

		$dok->laporan_hasil_sert = $fileName;
		$dok->save();

		return redirect()->back();
    }
}
