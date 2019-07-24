<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mou;
use App\BidPrice;

class MOUController extends Controller
{
    public function create(Request $request) {
    	$pdf = \PDF::loadView('dok_mou', ['nama' => $request->nama, 'produk' => $request->produk]);
        $output = $pdf->output();
        $fileName = 'MoU-'.uniqid().''.date('YmdHis').'.pdf';
        file_put_contents(public_path().'/dok/mou/'.$fileName, $output);

        $mou = new Mou;
        $mou->mou = $fileName;
        $mou->status = 1;
        $mou->created_at = date('Y-m-d H:i:s', strtotime('+2 day', strtotime(date('Y-m-d H:i:s'))));
        $mou->save();

    	return redirect()->back();
    }

    public function mou() {
    	return view('mou', ['dok' => Mou::first(), 'bp' => BidPrice::first()]);
    }

    public function mou_signed(Request $request, Mou $model) {
    	$file = $request->mou;
    	$fileName = uniqid().'-'.date('YmdHis').'.'.$file->extension();
    	if (!is_null($model->first()->mou)) {
    		unlink(public_path().'/dok/mou/'.$model->first()->mou);
    	}
    	$file->move(public_path().'/dok/mou', $fileName);

    	$dok = $model->first();
    	$dok->mou = $fileName;
        $dok->status = 2;
    	$dok->save();

    	return redirect()->back();
    }

    public function unlock_mou(Request $request) {
        $dok = Mou::first();
        $dok->created_at = date('Y-m-d H:i:s', strtotime('+2 day', strtotime(date('Y-m-d H:i:s'))));
        $dok->save();

        return redirect()->back();
    }
}