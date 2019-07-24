<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;

class ProdukController extends Controller
{
    public function index() {
    	$produk = \Auth::user()->produk()->get();
    	return view('produk.produk_client', compact('produk'));
    }

    public function create(Request $request) {
    	$produk = new Produk;
    	$produk->user_id = \Auth::user()->id;
    	$produk->produk = $request->produk;
    	$produk->save();

    	return redirect()->back();
    }
}
