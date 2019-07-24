<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;
use App\LaporanSert;

class SertController extends Controller
{
    public function index() {
    	$dok = LaporanSert::first();
    	$produk = Produk::first();
    	return view('draftSert', compact('produk'));
    }

    public function create(Request $request) {
    	$pdf = \PDF::loadView('draftSertDok');
    	$pdf->setPaper('A4','landscape');
    	$output = $pdf->output();
    	$fileName = 'Draft_Sertifikat_Vas_Bunga(PT.APA)-'.uniqid().''.date('YmdHis').'.pdf';
		file_put_contents(public_path().'/dok/draftSert/'.$fileName, $output);

		$produk = is_null(Produk::first()) ? new Produk : Produk::first();
		$produk->produk = 'Vas Bunga';
		$produk->draft_sert = $fileName;
		$produk->save();

		return redirect()->back();
    }

    public function getApprv() {
    	$produk = Produk::first();
    	return view('draftSert', compact('produk'));
    }

    public function postApprv(Request $request) {
    	$produk = Produk::first();
    	if ($request->apprv == '1') {
	    	$produk->status_sert_jadi = 1;
    	} else {
    		if (file_exists(public_path().'/dok/draftSert/'.$produk->draft_sert)) {unlink(public_path().'/dok/draftSert/'.$produk->draft_sert);}
    		$produk->draft_sert = null;
    		$produk->status_sert_jadi = null;
    	}
    	$produk->save();

    	return redirect()->back();
    }

    public function req_sert(Request $request) {
    	$produk = Produk::first();
    	$produk->request_sert = $request->req == '1' ? 'ambil' : 'kirim';
    	$produk->save();

    	return redirect()->back();
    }

    public function cetak_sert(Request $request) {
    	$dok = Produk::first();
    	$dok->status_sert_jadi = 2;
    	$dok->save();

    	return redirect()->back();
    }

    public function sert_jadi(Request $request) {
    	$dok = Produk::first();
    	$dok->status_sert_jadi = 3;
    	$dok->save();

    	return redirect()->back();
    }

    public function jadwalSert(Request $request) {
    	$dok = Produk::first();
    	$dok->tgl_request_sert = $request->tgl;
    	if (isset($request->resi)) {
    		$fileName = 'Resi_Pengiriman_Vas_Bunga(PT.APA)-'.uniqid().'.'.$request->resi->extension();
    		$request->resi->move(public_path().'/dok/resi', $fileName);
    		$dok->resi_pengiriman = $fileName;
    	}
    	$dok->save();

    	return redirect()->back();
    }
}