<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BidPrice;
use App\Mou;
use App\Invoice;
use App\User;
use App\Produk;
use App\TahapSert;

class BPController extends Controller
{
    protected function bidPrice($view, $id, $idProduk) {
        $user = User::find($id);
        $produk = Produk::where('id', $idProduk)->first();
        if (is_null($user) || is_null($produk)) {
            return redirect()->back();
        }
    	return view($view, ['model' => BidPrice::where('produk_id', $idProduk)->first(), 'mou' => MOU::where('produk_id', $idProduk)->first(), 'user' => $user, 'produk' => $produk, 'idProduk' => $idProduk, 'user_id' => $id]);
    }

    public function index($id, $idProduk) {
        return $this->bidPrice('bidPrice.bidPrice', $id, $idProduk);
    }

    public function create(Request $request, $idProduk, BidPrice $model) {
    	// validasi extensi file upload        
        $d = \Validator::make($request->file(), [
            'price' => 'required|integer',
        ],[
            'price'    => 'Input harga harus berupa angka'
        ]);
        if ($d->fails()) {return redirect()->back()->withErrors($d);}
        $pdf = \PDF::loadView('dok.dok_bidPrice', ['produk' => $request->produk, 'price' => $request->price]);
    	$output = $pdf->output();
    	$fileName = 'Penawaran_harga-'.uniqid().''.date('YmdHis').'.pdf';
        \Storage::put('dok/bidPrice/'.$fileName, $output);

		$dok = $model->first();
		if (is_null($dok)) {
			$dok = new $model;
		}
        $dok->produk_id = $idProduk;
        $dok->doc_maker = \Auth::user()->id;
		$dok->bid_price = $fileName;
		$dok->save();

		return redirect()->back();
    }

    public function getApprove($id, $idProduk) {
        return $this->bidPrice('bidPrice.apprv_bidPrice', $id, $idProduk);
    }

    public function approve(Request $request, $idProduk) {
    	$dok = BidPrice::where('produk_id', $idProduk)->first();
    	if ($request->choice == 'terima') {
	    	$dok->status = 1;
        	$dok->save();
            $tahap = TahapSert::where('produk_id', $idProduk)->first();
            $tahap->bid_price = 1;
            $tahap->save();
    	} else {
            \Storage::delete('dok/bidPrice/'.$dok->bid_price);
            $dok->delete();
    	}

    	return redirect()->back();
    }

    public function getForm_bayar() {
        $produk = \Auth::user()->produk();
        if (!is_null($produk)) {
            $bidPrice = BidPrice::where('produk_id', $produk->id)->first();
            $idProduk = $produk->id;
        } else {
            $bidPrice = null;
            $idProduk = null;
        }
        return view('bidPrice.form_bayar', ['bidPrice' => $bidPrice, 'idProduk' => $idProduk]);
    }

    public function form_bayar(Request $request, $idProduk) {
        $dateMax = date('Y-m-d H:i:s', strtotime('+7 day', strtotime(date('Y-m-d H:i:s'))));
        if (strtotime($request->tgl) > strtotime($dateMax)) {
            return redirect()->back()->with('errMsg', 'Waktu maksimal pembayaran yaitu 7 hari dari sekarang!');
        }

        $dok = BidPrice::where('produk_id', $idProduk)->first();
        $dok->verifikasi_bayar = 1;
        $dok->tanggal_bayar = $request->tgl;
        $dok->save();

        $tahap = TahapSert::where('produk_id', $idProduk)->first();
        $tahap->form_pembayaran = 1;
        $tahap->save();

        return redirect()->back();
    }

    public function getInvoice_create($id, $idProduk) {
        $user = User::find($id);
        $produk = Produk::where('id', $idProduk)->first();
        if (is_null($user) || is_null($produk)) {
            return redirect()->back();
        }
        $bp = BidPrice::where('produk_id', $idProduk)->first();
        if (is_null($bp)) {
            $inv = null;
        } else {
            $inv = Invoice::find($bp->invoice_id);
        }
        return view('invoice.invoice', ['model' => $bp, 'user' => $user, 'produk' => $produk, 'idProduk' => $idProduk, 'user_id' => $id, 'invoice' => $inv]); 
    }

    public function invoice_create(Request $request, $idProduk) {
        // validasi extensi file upload        
        $d = \Validator::make($request->file(), [
            'kb' => 'required|max:2000|mimes:pdf',
        ],[
            'max'    => 'Ukuran tidak boleh melebihi 2 megabytes',
            'mimes'      => 'Extensi file harus pdf',
        ]);
        if ($d->fails()) {return redirect()->back()->withErrors($d);}

        $file = $request->file('kb');
        $fileName = 'Kode_Biling-'.uniqid().''.date('YmdHis').'.pdf';
        $file->storeAs('dok/kodeBiling', $fileName);

        $pdf = \PDF::loadView('dok.dok_invoice', ['nama' => $request->nama, 'produk' => $request->produk]);
        $output = $pdf->output();
        $ifile = 'Invoice-'.uniqid().''.date('YmdHis').'.pdf';
        \Storage::put('dok/invoice/'.$ifile, $output);
        
        $invoice = new Invoice;
        $invoice->invoice = $ifile;
        $invoice->doc_maker = \Auth::user()->id;
        $invoice->kode_biling = $fileName;
        $invoice->created_at = date('Y-m-d H:i:s', strtotime('+7 day', strtotime(date('Y-m-d H:i:s'))));
        $invoice->save();

        $dok = BidPrice::where('produk_id', $idProduk)->first();
        $dok->invoice_id = $invoice->id;
        $dok->save();

        $tahap = TahapSert::where('produk_id', $idProduk)->first();
        $tahap->invoice = 1;
        $tahap->save();

        return redirect()->back();
    }

    public function getBukti() {
        $produk_id = \Auth::user()->id_produk();
        $bidPrice = BidPrice::where('produk_id', $produk_id)->first();
        if (!is_null($bidPrice)) {
            $invoice = Invoice::where('id', $bidPrice->invoice_id)->first();
        } else {
            $invoice = null;
        }
        return view('bidPrice.bukti_bayar', ['model' => $bidPrice, 'invoice' => $invoice]);
    }

    public function bukti_bayar(Request $request, $id) {
        // validasi extensi file upload
        $d = \Validator::make($request->file(), [
            'bbyr' => 'required|max:2000|mimes:png,jpeg,jpg,pdf,docx,doc',
        ],[
            'max' => 'Ukuran tidak boleh melebihi 2 megabytes',
            'mimes' => 'Extensi file yang diperbolehkan: png, jpeg, jpg, pdf, docx, doc',
        ]);
        if ($d->fails()) {return redirect()->back()->withErrors($d);}

        $file = $request->file('bbyr');
        $fileName = 'Bukti_pembayaran-'.uniqid().''.date('YmdHis').'.pdf';
        $file->storeAs('dok/buktiBayar', $fileName);

        $bidPrice = BidPrice::where('produk_id', $id)->first();
        $bidPrice->bukti_bayar = $fileName;
        $bidPrice->save();

        $tahap = TahapSert::where('produk_id', $id)->first();
        $tahap->bukti_bayar = 1;
        $tahap->save();

        return redirect()->back();
    }

    public function submit(Request $request, $idProduk) {
        $dok = BidPrice::where('produk_id', $idProduk)->first();
        $dok->status = 3;
        $dok->save();

        $tahap = TahapSert::where('produk_id', $idProduk)->first();
        $tahap->bid_price = 1;
        $tahap->save();

        return redirect()->back();
    }

    public function kbiling_upload(Request $request, $idInvoice) {
        // validasi extensi file upload
        $d = \Validator::make($request->file(), [
            'kb' => 'required|max:2000|mimes:pdf',
        ],[
            'max' => 'Ukuran tidak boleh melebihi 2 megabytes',
            'mimes' => 'Extensi file yang diperbolehkan: pdf',
        ]);
        if ($d->fails()) {return redirect()->back()->withErrors($d);}

        $invoice = Invoice::find($idInvoice);
        if (\Storage::exists('dok/kodeBiling/'.$invoice->kode_biling)) {
            \Storage::delete('dok/kodeBiling/'.$invoice->kode_biling);
        }
        $file = $request->file('kb');
        $fileName = 'Kode_Biling-'.uniqid().''.date('YmdHis').'.pdf';
        $file->storeAs('dok/kodeBiling', $fileName);

        $invoice->kode_biling = $fileName;
        $invoice->created_at = date('Y-m-d H:i:s', strtotime('+7 day', strtotime(date('Y-m-d H:i:s'))));
        $invoice->save();

        return redirect()->back();
    }
}
