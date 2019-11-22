<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persyaratan_luar_negeri extends Model
{
    protected $table = 'persyaratan_dok_luar_negeri';

    public function dok_importir() {
    	return $this->hasOne('App\DokImportir', 'id', 'dok_importir_id')->first();
    }

    public function dok_manufaktur() {
    	return $this->hasOne('App\DokManufaktur', 'id', 'dok_manufaktur_id')->first();
    }

    public function produk() {
    	return $this->hasOne('App\Produk', 'id', 'produk_id');
    }
}
