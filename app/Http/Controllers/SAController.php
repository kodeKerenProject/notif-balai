<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persyaratan_dalam_negeri;

class SAController extends Controller
{
	public function sa() {
		$dok = Persyaratan_dalam_negeri::first();
    	return view('applySA', compact('dok'));
	}

    public function applySA(Request $request) {
		$file = $request->file('dok');
		$fn = [];
		$fieldName = [];
    	for ($i=0;$i<count($file);$i++) {
    		array_push($fieldName, $request->fileName[$i]);
    		array_push($fn, uniqid().'-'.date('YmdHis').'.'.$file[$i]->extension());
			$file[$i]->move(public_path().'/dok/sa', $fn[$i]);
    	}

    	$dok = Persyaratan_dalam_negeri::first();
    	if (!is_null($dok)) {
    		foreach ($fieldName as $key => $value) {
	    		$dok->$value = $fn[$key];
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

    public function verifySA() {
    	$dok = Persyaratan_dalam_negeri::first();
    	return view('verifySA', compact('dok'));
    }

    public function verSA(Request $request) {
		$dok = Persyaratan_dalam_negeri::first();
		$jml = count($request->dok);
		foreach ($request->fileName as $key => $value) {
			if ($request->dok[$key] == 'null' && !is_null($dok->$value)) {
				unlink(public_path().'/dok/sa/'.$dok->$value);
				$dok->$value = null;
			}
		}
    	foreach ($request->dok as $key => $value) {
    		if ($request->dok[$key] == 'null') {
		    	$dok->sni = 2;
    			break;
    		}
    		$jml-=1;
    	}
    	if ($jml == 0) {
    		$dok->sni = 1;
    	}
    	$dok->save();

    	return redirect()->back();
    }
}
