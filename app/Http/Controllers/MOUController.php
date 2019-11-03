<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mou;
use App\User;
use App\Produk;
use App\Persyaratan_dalam_negeri;
use App\Persyaratan_luar_negeri;
use App\BidPrice;
use App\TahapSert;

class MOUController extends Controller
{
    public function cmou($id, $idProduk) {
        $user = User::find($id);
        $produk = \DB::table('produk')->select('id','produk')->where('id', $idProduk)->first();
        if (is_null($user) || is_null($produk)) {
            return redirect()->back();
        }
        $dok = $user->negeri == '1' ? Persyaratan_dalam_negeri::where('produk_id', $idProduk)->first() : Persyaratan_luar_negeri::where('produk_id', $idProduk)->first();
        $mou = Mou::where('produk_id', $idProduk)->first();

        return view('mou.mou', ['idProduk' => $idProduk, 'user' => $user, 'user_id' => $id, 'produk' => $produk, 'dok' => $dok, 'mou' => $mou]);
    }

    public function create(Request $request, $idProduk) {
    	$pdf = \PDF::loadView('dok.dok_mou', ['nama' => $request->nama, 'produk' => $request->produk]);
        $output = $pdf->output();
        $fileName = uniqid().''.date('YmdHis').'.pdf';
        \Storage::put('dok/mou/'.$fileName, $output);

        $mou = new Mou;
        $mou->produk_id = $idProduk;
        $mou->mou = $fileName;
        $mou->doc_maker = \Auth::user()->id;
        $mou->status = 1;
        $mou->created_at = date('Y-m-d H:i:s', strtotime('+3 day', strtotime(date('Y-m-d H:i:s'))));
        $mou->save();

        $tahap = TahapSert::where('produk_id', $idProduk)->first();
        $tahap->mou = 1;
        $tahap->save();

    	return redirect()->back();
    }

    public function mou() {
        $idProduk = \Auth::user()->id_produk();
        $dok = \Auth::user()->negeri == '1' ? \DB::table('persyaratan_dok_dalam_negeri')->select('sni')->where('produk_id', $idProduk)->first() : \DB::table('persyaratan_dok_dalam_negeri')->select('sni')->where('produk_id', $idProduk)->first();
    	return view('mou.signMou', ['mou' => Mou::where('produk_id', $idProduk)->first(), 'dok' => $dok]);
    }

    public function mou_signed(Request $request, $id) {
        // validasi extensi file upload        
        $d = \Validator::make($request->file(), [
            'mou' => 'required|max:2000|mimes:png,jpeg,jpg,pdf,docx,doc',
        ],[
            'max'    => 'Ukuran tidak boleh melebihi 2 megabytes',
            'mimes'      => 'Extensi file yang diperbolehkan: png, jpeg, jpg, pdf, docx, doc',
        ]);
        if ($d->fails()) {return redirect()->back()->withErrors($d);}

    	$file = $request->mou;
        $mou = MOU::find($id);
    	$fileName = uniqid().'-'.date('YmdHis').'.'.$file->extension();
    	if (!is_null($mou->mou)) {
            \Storage::delete('dok/mou/'.$mou);
    	}
        $file->storeAs('dok/mou', $fileName);

    	$dok = $mou;
    	$dok->mou = $fileName;
        $dok->status = 2;
    	$dok->save();

        $tahap = TahapSert::where('produk_id', $mou->produk_id)->first();
        $tahap->sign_mou = 1;
        $tahap->save();

    	return redirect()->back();
    }

    public function unlock_mou(Request $request, $id) {
        $dok = Mou::where('produk_id', $id)->first();
        $dok->created_at = date('Y-m-d H:i:s', strtotime('+3 day', strtotime(date('Y-m-d H:i:s'))));
        $dok->save();

        return redirect()->back();
    }
}