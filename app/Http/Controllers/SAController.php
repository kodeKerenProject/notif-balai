<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persyaratan_dalam_negeri;
use App\Persyaratan_luar_negeri;
use App\DokImportir;
use App\DokManufaktur;
use App\Mou;
use App\User;
use App\Role;
use App\Produk;
use App\Notifications\ApplySaNotif;
use Notification;

class SAController extends Controller
{
    protected function dok() {
        return $model = \Auth::user()->negeri == '1' ? Persyaratan_dalam_negeri::first() : Persyaratan_luar_negeri::first();
    }

	public function sa() {
		$dok = $this->dok();
        $dokImportir = !is_null($dok) ? $dok->dok_importir()->first() : null;
        $dokManufaktur = !is_null($dok) ? $dok->dok_manufaktur()->first() : null;
        $dokDalamNegeri = !is_null($dok) ? $dok->dok_importir()->first()->more_doc()->first() : null;
    	return view('applySA.applySA', compact('dok', 'dokImportir', 'dokManufaktur', 'dokDalamNegeri'));
	}

    public function applySA(Request $request, Persyaratan_dalam_negeri $model) {

		$file = $request->file('dok');
		$fn = [];
		$fieldName = [];
    	for ($i=0;$i<count($file);$i++) {
    		array_push($fieldName, $request->fileName[$i]);
    		array_push($fn, uniqid().'-'.date('YmdHis').'.'.$file[$i]->extension());
			$file[$i]->move(public_path().'/dok/sa', $fn[$i]);
    	}

        if (is_null(Produk::where('user_id', \Auth::user()->id))) {
            $produk = new Produk;
            $produk->user_id = \Auth::user()->id;
            $produk->produk = $request->produk;
            $produk->save();
        }

    	$dok = $model->first();
        if (is_null($dok)) {
    		foreach ($fieldName as $key => $value) {
            $dok = new $model;
        }
    		$dok->sni = 3;
    	} else {
	    	$dok = new Persyaratan_dalam_negeri;
    	foreach ($fieldName as $key => $value) {
    		$dok->$value = $fn[$key];
    	}
		$dok->sni = 3;
    	}
    	$dok->save();

    	return redirect()->back();
    }

    public function applySAluar(Request $request, Persyaratan_luar_negeri $model) {
        // filter dok sesuai tabel DB
        $arr = [[new Persyaratan_dalam_negeri, 'sa'], [new DokImportir, 'dokImportir'],[new DokManufaktur, 'dokManufaktur']];
        foreach ($request->fileName as $key => $value) {
            if (explode(',', $value)[1] == 'sa') {$index = 0;}
            elseif (explode(',', $value)[1] == 'dokImportir') {$index = 1;}
            else {$index = 2;}
            array_push($arr[$index], [explode(',', $value)[0], $request->dok[$key]]);
        }

        // upload dok
        $saId = null;
        $dokImportirId = null;
        $dokManufakturId = null;
        foreach ($arr as $key => $value) {
            $table = !is_null($value[0]->first()) ? $value[0]->first() : $value[0];
            for ($i=2; $i<count($value); $i++) {
                $fn = uniqid().'-'.date('YmdHis').'.'.$value[$i][1]->extension();
                $value[$i][1]->move(public_path().'/dok/'.$value[1], $fn);
                $field = $value[$i][0];
                $table->$field = $fn;
            }
            if ($key == 1 && is_null($table->persyaratan_dok_dalam_negeri_id)) {$table->persyaratan_dok_dalam_negeri_id = $saId;}
            
            // set kelengkapan dokumen
            if ($key == 0) {$table->sni = '3';}
            else {$table->lengkap = 3;}
            $table->save();
            if ($key == 0) {$saId = $table->id;}

            // set dok_importir_id dan dok_manufaktur_id foreign key
            if ($key == 1) {$dokImportirId = $table->id;}
            elseif ($key == 2) {$dokManufakturId = $table->id;}
        }
        $dok = !is_null(Persyaratan_luar_negeri::first()) ? Persyaratan_luar_negeri::first() : new Persyaratan_luar_negeri;
        $dok->sni = 3;
        if (is_null(Persyaratan_luar_negeri::first())) {
            $dok->dok_importir_id = $dokImportirId;
            $dok->dok_manufaktur_id = $dokManufakturId;
        }
        $dok->save();

        return redirect()->back();
    }
}
