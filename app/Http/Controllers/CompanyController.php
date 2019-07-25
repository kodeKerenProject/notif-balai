<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\User;
use App\Persyaratan_dalam_negeri;
use App\Persyaratan_luar_negeri;
use App\Mou;

class CompanyController extends Controller
{
    public function list() {
        $roleId = Role::where('name', 'client')->first()->id;
        $client = \DB::table('users')->where('role_id', $roleId)->join('role', 'role.id', '=', 'users.role_id')->select('users.id', 'users.nama_perusahaan', 'users.pimpinan_perusahaan')->get();
        return view('company.company_list', compact('client'));
    }

    public function single($id) {
        $user = User::find($id);
        if (is_null($user)) {
            return redirect()->back();
        }
        return view('company.company_product', compact('user'));
    }

    public function verifySA($id, $idProduk) {
    	$user = User::find($id);
    	if (is_null($user)) {
            return redirect()->back();
        }
    	$dok = \Auth::user()->negeri == '1' ? Persyaratan_dalam_negeri::find($idProduk) : Persyaratan_luar_negeri::find($idProduk);
    	$dokImportir = !is_null($dok) ? $dok->dok_importir()->first() : null;
        $dokManufaktur = !is_null($dok) ? $dok->dok_manufaktur()->first() : null;
        $dokDalamNegeri = !is_null($dok) ? $dok->dok_importir()->first()->more_doc()->first() : null;
    	$mou = Mou::first();
    	return view('applySA.verifySA', compact('dok', 'mou', 'user', 'dokImportir', 'dokManufaktur', 'dokDalamNegeri'));
    }

    public function verSA(Request $request) {
		$dok = \Auth::user()->negeri == '1' ? Persyaratan_dalam_negeri::first() : Persyaratan_luar_negeri::first();
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
