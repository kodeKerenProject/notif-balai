<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persyartan_dalam_negeri;

class SAController extends Controller
{
    public function applySA(Request $request) {
    	$this->validate($request, [
			'dok[]' => 'required',
		]);

		$file = $request->file('dok');
		$filename = $file->getClientOriginalName().'- '.date('YmdHis');
		$tujuan_upload = 'dok/sa';
 
		$file->move($tujuan_upload,$filename);
    }
}
