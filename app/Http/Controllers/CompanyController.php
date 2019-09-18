<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\User;
use App\Persyaratan_dalam_negeri;
use App\Persyaratan_luar_negeri;
use App\Produk;
use App\Mou;
use App\DokImportir;
use App\DokManufaktur;
use App\TahapSert;

class CompanyController extends Controller
{
    public function list() {
        $roleId = Role::where('role', 'client')->first()->id;
        $client = \DB::table('users')->where('role_id', $roleId)->join('role', 'role.id', '=', 'users.role_id')->select('users.id', 'users.nama_perusahaan', 'users.pimpinan_perusahaan')->get();
        return view('company.company_list', compact('client'));
    }

    public function single($id) {
        $user = User::find($id);
        if (is_null($user)) {
            return redirect()->back();
        }
        $role = \Auth::user()->role()->first()->role;
        if ($role == 'pemasaran') {$link = 'sert';}
        elseif ($role == 'kerjasama') {$link = 'cmou';}
        elseif ($role == 'kabidpjt') {$link = 'approval';}
        elseif ($role == 'keuangan') {$link = 'invoice';}
        elseif ($role == 'sertifikasi') {$link = 'jadwalAudit';}
        elseif ($role == 'auditor') {$link = 'dokSert';}
        elseif ($role == 'kabidpaskal') {$link = 'apprv_jadwalAudit';}
        elseif ($role == 'tim_teknis') {$link = 'rekomendasiRapatTeknis';}
        elseif ($role == 'komite_timTeknis') {$link = 'keputusanTeknis';}
        elseif ($role == 'subag_umum') {$link = 'pengirimanSert';}
        return view('company.company_product', ['user_id' => $id, 'user' => $user, 'link' => $link]);
    }

    public function verifySA($id, $idProduk) {
    	$user = User::find($id);
        $produk = Produk::where('id', $idProduk)->first();
    	if (is_null($user) || is_null($produk)) {
            return redirect()->back();
        }
    	$dok = $user->negeri == '1' ? Persyaratan_dalam_negeri::where('produk_id', $idProduk)->first() : Persyaratan_luar_negeri::where('produk_id', $idProduk)->first();
    	$dokImportir = !is_null($dok) && $user->negeri == '2' ? $dok->dok_importir()->first() : null;
        $dokManufaktur = !is_null($dok) && $user->negeri == '2' ? $dok->dok_manufaktur()->first() : null;
        $dokDalamNegeri = !is_null($dok) && $user->negeri == '2' ? $dok->dok_importir()->first()->more_doc()->first() : null;
    	return view('applySA.verifySA', compact('dok', 'user', 'dokImportir', 'dokManufaktur', 'dokDalamNegeri', 'idProduk', 'produk', 'url'), ['user_id' => $id]);
    }

    public function verSA(Request $request, $id) {
        $dok = Persyaratan_dalam_negeri::where('produk_id', $id)->first();
		$jml = count($request->dok);
		foreach ($request->fileName as $key => $value) {
			if ($request->dok[$key] == 'null' && !is_null($dok->$value)) {
                \Storage::delete('dok/sa/'.$dok->$value);
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
            $tahap = TahapSert::where('produk_id', $id)->first();
            $tahap->apply_sa = 1;
            $tahap->save();
    	}
    	$dok->save();

    	return redirect()->back();
    }

    public function verSALuar(Request $request, $id) {
        // filter dok sesuai tabel DB
        $dok = Persyaratan_luar_negeri::where('produk_id', $id)->first();
        $arr = [[$dok->dok_importir()->first()->more_doc()->first(), 'sa'], [$dok->dok_importir()->first(), 'dokImportir'],[$dok->dok_manufaktur()->first(), 'dokManufaktur']];
        foreach ($request->fileName as $key => $value) {
            if (explode(',', $value)[1] == 'sa') {$index = 0;}
            elseif (explode(',', $value)[1] == 'dokImportir') {$index = 1;}
            else {$index = 2;}
            array_push($arr[$index], [explode(',', $value)[0], $request->dok[$key]]);
        }

        $sni = [];
        foreach ($arr as $key => $value) {
            for($i=2;$i<count($value);$i++) {
                $field = $value[$i][0];
                // hapus dok jika tidak lengkap
                if ($value[$i][1] == 'null' && !is_null($value[0]->$field)) {
                    \Storage::delete('dok/'.$value[1].'/'.$value[0]->$field);
                    $value[0]->$field = null;
                }
            }
            // cek kelengkapan dok - 1
            $jmlDok = count($arr)-2;
            $lengkap = $value[1] == 'sa' ? 'sni' : 'lengkap';
            for ($j=2; $j < count($arr); $j++) { 
                if ($value[$j][1] == 'null') {
                    $value[0]->$lengkap = 2;
                    break;
                }
                $jmlDok-=1;
            }
            if ($jmlDok == 0) {$value[0]->$lengkap = 1;}
            array_push($sni, $value[0]->$lengkap);
            $value[0]->save();
        }
        // cek kelengkapan dok - 2
        foreach ($sni as $key => $value) {
            if ($value == 2) {$dok->sni = 2;break;}
            if ($key == 2 && $value == 1) {
                $dok->sni = 1;
                $tahap = TahapSert::where('produk_id', $id)->first();
                $tahap->apply_sa = 1;
                $tahap->save();
            }
        }
        $dok->save();

        return redirect()->back();
    }
}
