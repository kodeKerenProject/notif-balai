<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DokImportir extends Model
{
    protected $table = 'dok_importir';

    public function getReview() {
    	return $this->hasOne('App\ReviewDokImportir', 'id', 'review_dok_importir_id')->first();
    }
}
