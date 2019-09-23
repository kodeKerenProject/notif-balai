<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persyaratan_dalam_negeri extends Model
{
    protected $table = 'persyaratan_dok_dalam_negeri';

    public function getDokImpor() {
    	return $this->hasOne('App\DokImportir', 'id');
    }
    
    public function produk_relation() {
    	return $this->hasOne('App\Produk','id');
    }

    public function review() {
    	$dokImportir = $this->getDokImpor()->first();
    	$result = null;
    	if (!is_null($dokImportir)) {
    		$result = $dokImportir->getReview();
    	}
    	return $result;
    }

    public function info_tambahan($request, $produk_id, $model) {
        $db = $model->where('produk_id', $produk_id)->first();
        if (is_null($db)) {
            $dbs = $model;
            $dbs->produk_id = $produk_id;
        } else {$dbs = $db;}

        $dbs->lengkap = 3;
        for ($i=1; $i < count($request); $i++) {
            $req = 'opsi'.$i;
            if (!isset($request[$req])) {
                continue;
            }
            $field1 = 'kuis'.$i.'_opsi';
            $field2 = 'kuis'.$i.'_isi';
            $isi = null;
            $opsi = $request[$req] == 'ya' ? 1 : 0;
            if ($i == 1 && $request[$req] == 'ya') {
                $isi = json_encode([$request['penerbitSertSNI'], $request['masaBerlakuSNI']], true);
            } elseif ($i == 2) {
                $isi = json_encode([$request['detailGroup']], true);
            } elseif ($i == 3 && $request[$req] == 'ya') {
                $isi = json_encode([$request['namaComp'], $request['alamatComp']], true);
            } elseif ($i == 4) {
                if ($request[$req] == 'ya') {
                    $isi = json_encode([$request['perbitSertISO'], $request['masaBerlakuISO']], true);
                } else {
                    $isi = json_encode([$request['opsi4_tidak']], true);
                }
            }
            $dbs->$field1 = $opsi;
            if ($i != 5) {$dbs->$field2 = $isi;}
        }
        $dbs->kuis6 = $request['siapSertDate'];
        $dbs->save();
        return $dbs;
    }

    public function verifyKuis($request, $db, $infoT) {
        $pesan = $request['pesan'];
        $infoDB = $db;
        $success = true;
        $failed = [];
        foreach ($infoT as $key => $value) {
            if ($value != 1) {
                $success = false;
                array_push($failed, $key);
            }
        }
        $psn = json_encode([$failed, $pesan], true);
        $infoDB->lengkap = !$success ? 2 : 1;
        $infoDB->pesan = $psn;
        $infoDB->save();
        return $infoDB->lengkap;
    }
}
