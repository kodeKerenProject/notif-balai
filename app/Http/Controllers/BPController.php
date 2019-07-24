<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BidPrice;
use App\Mou;
use App\Invoice;

class BPController extends Controller
{
    public function index() {
    	return view('bidPrice', ['model' => BidPrice::first(), 'mou' => MOU::first()]);
    }

    public function create(Request $request, BidPrice $model) {
    	$pdf = \PDF::loadView('dok_bidPrice', ['produk' => $request->produk, 'price' => $request->price]);
    	$output = $pdf->output();
    	$fileName = 'Penawaran_harga-'.uniqid().''.date('YmdHis').'.pdf';
		file_put_contents(public_path().'/dok/bidPrice/'.$fileName, $output);

		$dok = $model->first();
		if (is_null($dok)) {
			$dok = new $model;
		}
		$dok->bid_price = $fileName;
		$dok->save();

		return redirect()->back();
    }

    public function approve(Request $request) {
    	$dok = BidPrice::first();
    	if ($request->choice == 'terima') {
	    	$dok->status = 1;
    	} else {
	    	$dok->status = 2;
	    	unlink(public_path().'/dok/bidPrice/'.$dok->bid_price);
	    	$dok->bid_price = null;
    	}
    	$dok->save();

    	return redirect()->back();
    }

    public function form_bayar(Request $request) {
        $dok = BidPrice::first();
        $dok->verifikasi_bayar = 1;
        $dok->tanggal_bayar = $request->tgl;
        $dok->save();

        return redirect()->back();
    }

    public function invoice_create(Request $request) {
        // $file = $request->kb;
        // $fileName = 'Invoice-'.uniqid().''.date('YmdHis').'.pdf';
        // $file->move(public_path().'/dok/invoice', $fileName);
        $pdf = \PDF::loadView('dok_invoice', ['nama' => $request->nama, 'produk' => $request->produk]);
        $output = $pdf->output();
        $ifile = 'Invoice-'.uniqid().''.date('YmdHis').'.pdf';
        file_put_contents(public_path().'/dok/invoice/'.$ifile, $output);
        
        $invoice = new Invoice;
        $invoice->invoice = $ifile;
        $invoice->save();

        $dok = BidPrice::first();
        $dok->invoice_id = $invoice->id;
        $dok->save();

        return redirect()->back();
    }

    public function bukti_bayar(Request $request) {
        $file = $request->bbyr;
        $fileName = 'Bukti_Pembayaran-'.uniqid().''.date('YmdHis').'.pdf';
        $file->move(public_path().'/dok/buktiBayar', $fileName);

        $dok = BidPrice::first();
        $dok->bukti_bayar = $fileName;
        $dok->save();

        return redirect()->back();
    }
}
