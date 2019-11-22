<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Notification;
use App\Http\Requests\ApplySA;
use App\Persyaratan_dalam_negeri;
use App\Persyaratan_luar_negeri;
use App\DokImportir;
use App\DokManufaktur;
use App\Mou;
use App\User;
use App\Role;
use App\Produk;
use App\TahapSert;
use App\Notifications\ApplySaNotif;
use App\InfoTambahan;
use Illuminate\Support\Arr;

class SAController extends Controller
{
    protected function dok() {
        $produk_id = !is_null(\Auth::user()->produk()) ? \Auth::user()->produk()->id : null;
        $model = \Auth::user()->negeri == '1' ? new Persyaratan_dalam_negeri : new Persyaratan_luar_negeri;
        return [$model->where('produk_id', $produk_id)->first(), $produk_id];
    }

    public function list_produk() {
        $produk = \Auth::user()->produk_client();
        return view('list_produk.list_produk', ['produk' => $produk]);
    }
    
    public function sa() {
        $dok = is_null($this->dok()[1]) ? null : $this->dok()[0];
        $dokImportir = !is_null($dok) && \Auth::user()->negeri == '2' ? $dok->dok_importir()->first() : null;
        $dokManufaktur = !is_null($dok) && \Auth::user()->negeri == '2' ? $dok->dok_manufaktur()->first() : null;
        $dokDalamNegeri = !is_null($dok) && \Auth::user()->negeri == '2' ? $dok->dok_importir()->first()->more_doc()->first() : null;
        $infoDB = InfoTambahan::where('produk_id', $this->dok()[1])->first();
        $infoIsi = function($data) {
            return json_decode($data);
        };
        $opsi = !is_null($infoDB) && !is_null($infoDB->pesan) ? json_decode($infoDB->pesan)[0] : null;
        $pesan = !is_null($infoDB) && !is_null($infoDB->pesan) ? json_decode($infoDB->pesan)[1] : null;
        $cekOpsi = function($op, $opsi) {
            if (!is_null($opsi)) {
                foreach ($opsi as $key => $value) {
                    if ($value == $op) {
                        return 1;
                    }
                }
            }
            return 0;
        };
        return view('applySA.applySA', compact('dok', 'dokImportir', 'dokManufaktur', 'dokDalamNegeri', 'infoDB', 'opsi', 'cekOpsi', 'infoIsi', 'pesan'));
    }

    public function applySA(Request $request) {
        // validasi extensi file upload
        $d = \Validator::make($request->file(), [
            'dok.*' => 'required|max:2000|mimes:png,jpeg,jpg,pdf,docx,doc',
        ],[
            'max'    => 'Ukuran tidak boleh melebihi 2 megabytes',
            'mimes'      => 'Extensi file yang diperbolehkan: png, jpeg, jpg, pdf, docx, doc',
        ]);
        if ($d->fails()) {return redirect()->back()->withErrors($d);}

        if (!is_null($this->dok()[0])) {
            $dok = $this->dok()[0];
        } else {
            $dok = new Persyaratan_dalam_negeri;
            $dok->produk_id = $this->dok()[1];
            $tahap = new TahapSert;
            $tahap->produk_id = $this->dok()[1];
            $tahap->save();
    	}

        $model = new Persyaratan_dalam_negeri;
        $formKuesioner = Arr::except($request->all(), ['_token', 'fileName', 'dok']);
        if ($this->dok()[0]->sni != 1) {
            $fn = [];
        	$fieldName = [];
        	for ($i=0;$i<count($request->file('dok'));$i++) {
                if (isset($request->file('dok')[$i])) {
        		  array_push($fieldName, $request->fileName[$i]);
        		  array_push($fn, uniqid().'-'.date('YmdHis').'.'.$request->file('dok')[$i]->extension());
                  $request->file('dok')[$i]->storeAs('dok/sa', $fn[$i]);
                }
        	}
        	foreach ($fieldName as $key => $value) {
        		$dok->$value = $fn[$key];
        	}
        }

        if (is_null(\Auth::user()->produk())) {
            $produk = new Produk;
            $produk->user_id = \Auth::user()->id;
            $produk->produk = $request->produk;
            $produk->save();
        }

  		$dok->sni = 3;
    	$dok->save();
        $model->info_tambahan($formKuesioner, $this->dok()[1], new InfoTambahan);

    	return redirect()->back();
    }

    public function applySAluar(Request $request, Persyaratan_luar_negeri $model) {
        $d = \Validator::make($request->file(), [
            'dok.*' => 'required|max:2000|mimes:png,jpeg,jpg,pdf,docx,doc',
        ],[
            'max'    => 'Ukuran tidak boleh melebihi 2 megabytes',
            'mimes'      => 'Extensi file harus: png, jpeg, jpg, pdf, docx, doc',
        ]);
        if ($d->fails()) {return redirect()->back()->withErrors($d);}
        
        // filter dok sesuai tabel DB
        $arr = [
            [new DokImportir, 'dokImportir'],
            [new DokManufaktur, 'dokManufaktur']
        ];
        foreach ($request->fileName as $key => $value) {
            if (explode(',', $value)[1] == 'dokImportir') {$index = 0;}
            else {$index = 1;}
            $review = isset($request->review[$key]) ? $request->review[$key] : null;
            array_push($arr[$index], [explode(',', $value)[0], $request->dok[$key], $review]);
        }

        // input produk
        $produk = \Auth::user()->produk();
        if (is_null($produk)) {
            $produk = new Produk;
            $produk->user_id = \Auth::user()->id;
            $produk->produk = $request->produk;
            $produk->save();
        }

        // upload dok
        $dokImportirId = null;
        $dokManufakturId = null;
        $dokLuar = $this->dok()[0];
        $dokEmpty = new Persyaratan_luar_negeri;        
        foreach ($arr as $key => $value) {
            $table = $dokEmpty->getTable($value[0], $key, $dokLuar);
            for ($i=2; $i<count($value); $i++) {
                $fn = uniqid().'-'.date('YmdHis').'.'.$value[$i][1]->extension();
                $value[$i][1]->storeAs('dok/'.$value[1], $fn);
                $field = $value[$i][0];
                $table->$field = $fn;
            }
            
            // set kelengkapan dokumen
            $table->lengkap = '3';
            $table->save();
            // set dok_importir_id dan dok_manufaktur_id foreign key
            if ($key == 1) {$dokImportirId = $table->id;}
            elseif ($key == 2) {$dokManufakturId = $table->id;}
        }
        if (!is_null($this->dok()[0])) {
            $dok = new Persyaratan_luar_negeri;
            $dok->sni = 3;
            if (is_null($this->dok()[0])) {
                $dok->produk_id = \Auth::user()->id_produk();
                $dok->dok_importir_id = $dokImportirId;
                $dok->dok_manufaktur_id = $dokManufakturId;
            }
            $dok->save();
        }

        return redirect()->back();
    }
}
