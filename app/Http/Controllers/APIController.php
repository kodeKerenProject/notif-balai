<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persyaratan_dalam_negeri;
use App\Transformers\saTransformer;
use App\Mou;

class APIController extends Controller
{
    public function getSA(Persyaratan_dalam_negeri $dok_negeri)
    {
    	$docs = $dok_negeri->all();

    	return fractal()
    		->collection($docs)
    		->transformWith(new saTransformer)
    		->toArray();
    }

    public function verifSA(Request $request,Persyaratan_dalam_negeri $model){
    	$dok = $model->first();
		$jml = count($request->filename);
		$fileCollection = [];

		foreach ($request->filename as $key => $value) {
			if ($request->dok[$key] == 'null' && !is_null($dok->$value)) {
				unlink(public_path().'/dok/sa/'.$dok->$value);
				array_push($fileCollection, $dok->$value);
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

    	$mou = new Mou;
    	$mou->status = null;
    	$mou->save();


    	return fractal()
    		->collection($fileCollection)
    		->transformWith(new saTransformer)
    		->toArray();
    }
}
