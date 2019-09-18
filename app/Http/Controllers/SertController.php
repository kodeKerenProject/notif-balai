<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;
use App\LaporanSert;
use App\User;
use App\TahapSert;

class SertController extends Controller
{
    public function index($id, $idProduk) {
        $user = User::find($id);
        $produk = Produk::where('id', $idProduk)->first();
        if (is_null($user) || is_null($produk)) {
            return redirect()->back();
        }
    	$dok = LaporanSert::where('produk_id', $idProduk)->first();
    	return view('draftSert.draftSert', ['user' => $user, 'produk' => $produk, 'idProduk' => $idProduk, 'user_id' => $id, 'dok' => $dok]);      
    }

    public function create(Request $request, $idProduk) {
		$produk = Produk::find($idProduk);
    	$pdf = \PDF::loadView('dok.draftSertDok');
    	$pdf->setPaper('A4','landscape');
    	$output = $pdf->output();
    	$fileName = 'Draft_Sertifikat_'.$produk->produk.'('.$request->user.')'.'-'.uniqid().''.date('YmdHis').'.pdf';
        \Storage::put('dok/draftSert/'.$fileName, $output);

		$produk->draft_sert = $fileName;
		$produk->save();

		return redirect()->back();
    }

    public function getApprv() {
    	$produk = \Auth::user()->produk();
    	return view('draftSert.apprvSert', ['produk' => $produk]);
    }

    public function sert_jadi($id, $idProduk) {
        $user = User::find($id);
        $produk = Produk::where('id', $idProduk)->first();
        if (is_null($user) || is_null($produk)) {
            return redirect()->back();
        }
        return view('draftSert.kirimNotifSert', ['user' => $user, 'produk' => $produk, 'idProduk' => $idProduk, 'user_id' => $id]);

    }

    public function postApprv(Request $request) {
    	$produk = \Auth::user()->produk();
    	if ($request->apprv == '1') {
	    	$produk->status_sert_jadi = 1;
    	} else {
    		if (\Storage::exists('dok/draftSert/'.$produk->draft_sert)) {
                \Storage::delete('dok/draftSert/'.$produk->draft_sert);
            }
    		$produk->draft_sert = null;
    		$produk->status_sert_jadi = null;
    	}
    	$produk->save();

        $tahap = TahapSert::where('produk_id', $produk->id)->first();
        $tahap->draftSert = 1;
        $tahap->save();

    	return redirect()->back();
    }

    public function req_sert() {
        $produk = \Auth::user()->produk();
        return view('draftSert.reqSertJadi', ['produk' => $produk]);
    }

    public function postReq_sert(Request $request) {
    	$produk = \Auth::user()->produk();
    	$produk->request_sert = $request->req == '1' ? 'ambil' : 'kirim';
    	$produk->save();

    	return redirect()->back();
    }

    public function cetak_sert(Request $request, $idProduk) {
    	$dok = Produk::where('id', $idProduk)->first();
    	$dok->status_sert_jadi = 2;
    	$dok->save();

        $tahap = TahapSert::where('produk_id', $idProduk)->first();
        $tahap->cetakSert = 1;
        $tahap->save();

    	return redirect()->back();
    }

    public function postSert_jadi(Request $request, $idProduk) {
    	$dok = Produk::where('id', $idProduk)->first();
    	$dok->status_sert_jadi = 3;
    	$dok->save();

    	return redirect()->back();
    }

    public function jadwalSert($id, $idProduk) {
        $user = User::find($id);
        $produk = Produk::where('id', $idProduk)->first();
        if (is_null($user) || is_null($produk)) {
            return redirect()->back();
        }
        $produk = Produk::where('id', $idProduk)->first();
        return view('draftSert.jadwalSert', ['produk' => $produk, 'user' => $user, 'produk' => $produk, 'idProduk' => $idProduk, 'user_id' => $id]);
    }

    public function postJadwalSert(Request $request, $idProduk) {
    	$dok = Produk::where('id', $idProduk)->first();
    	$dok->tgl_request_sert = $request->tgl;
    	if (isset($request->resi)) {
    		$fileName = 'Resi_Pengiriman_'.$dok->produk.'('.$request->user.')'.uniqid().'.'.$request->resi->extension();
    		$request->resi->storeAs('dok/resi', $fileName);
    		$dok->resi_pengiriman = $fileName;
    	}
    	$dok->save();

        $tahap = TahapSert::where('produk_id', $idProduk)->first();
        $tahap->jadwalSert = 1;
        $tahap->save();

    	return redirect()->back();
    }

    public function pengirimanSert($id, $idProduk) {
        $user = User::find($id);
        $produk = Produk::where('id', $idProduk)->first();
        if (is_null($user) || is_null($produk)) {
            return redirect()->back();
        }
        return view('draftSert.pengirimanSert', ['produk' => $produk, 'user' => $user, 'produk' => $produk, 'idProduk' => $idProduk, 'user_id' => $id]);
    }
}