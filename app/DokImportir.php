<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DokImportir extends Model
{
    protected $table = 'dok_importir';

    public function more_doc() {
    	return $this->hasOne('App\Persyaratan_dalam_negeri', 'id', 'persyaratan_dok_dalam_negeri_id');
    }

    public function getReview() {
    	return $this->hasOne('App\ReviewDokImportir', 'id');
    }
}
