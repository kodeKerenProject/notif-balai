<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persyaratan_dalam_negeri extends Model
{
    protected $table = 'persyaratan_dok_dalam_negeri';

    public function getDokImpor() {
    {
    	return $this->hasOne('App\DokImportir', 'id');
    }
    
     public function produk_relation()
    {
    	return $this->hasOne('App\Produk','id');
    }
}
