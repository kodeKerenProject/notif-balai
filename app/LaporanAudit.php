<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaporanAudit extends Model
{
    protected $table = 'laporan_audit';

    public function jadwal_audit() {
    	return $this->hasOne('App\JadwalAudit', 'id');
    }

    public function dokImportir() {
    	return $this->hasOne('App\DokImportir', 'id', 'dok_importir_id')->first();
    }

    public function dokManufaktur() {
    	return $this->hasOne('App\DokManufaktur', 'id', 'dok_manufaktur_id')->first();
    }

    public function tinjauanPP() {
    	return $this->hasOne('App\TinjauanPP', 'id', 'tinjauan_pp_id')->first();
    }

    public function cekDokSert_arr($request) {
        $arr = [
            [new DokImportir, 'dokImportir', new ReviewDokImportir, 'review_dok_importir_id', 'dok_importir_id'],
            [new DokManufaktur, 'dokManufaktur', new ReviewDokManufaktur, 'review_dok_manufaktur_id', 'dok_manufaktur_id'],
            [new TinjauanPP, 'tinjauanPP', new ReviewTinjauanPP, 'review_tinjauan_pp_id', 'tinjauan_pp_id']
        ];
        foreach ($request->fileName as $key => $value) {
            if (explode(',', $value)[1] == 'dokImportir') {$index = 0;}
            elseif (explode(',', $value)[1] == 'dokManufaktur') {$index = 1;}
            else {$index = 2;}
            $review = isset($request->review[$key]) ? $request->review[$key] : null;
            array_push($arr[$index], [explode(',', $value)[0], $request->dok[$key], $review]);
        }

        return $arr;
    }

    public function getTableAudit($table, $key, $la) {
        if (!is_null($la) && $key == 0) {
            $getTable = !is_null($la->dokImportir()) ? $la->dokImportir() : $table;
        } elseif (!is_null($la) && $key == 1) {
            $getTable = !is_null($la->dokManufaktur()) ? $la->dokManufaktur() : $table;
        } elseif (!is_null($la) && $key == 2) {
            $getTable = !is_null($la->tinjauanPP()) ? $la->tinjauanPP() : $table;
        }

        return $getTable;
    }

    public function dokAudit($request) {
        $arr = [
            [new DokImportir, 'dokImportir'],
            [new DokManufaktur, 'dokManufaktur'],
            [new TinjauanPP, 'tinjauanPP']
        ];
        foreach ($request->fileName as $key => $value) {
            if (explode(',', $value)[1] == 'dokImportir') {$index = 0;}
            elseif (explode(',', $value)[1] == 'dokManufaktur') {$index = 1;}
            else {$index = 2;}
            array_push($arr[$index], [explode(',', $value)[0], $request->dok[$key]]);
        }

        return $arr;
    }
}
