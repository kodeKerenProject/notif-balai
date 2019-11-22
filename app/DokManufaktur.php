<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DokManufaktur extends Model
{
    protected $table = 'dok_manufaktur';

    public function getReview() {
    	return $this->hasOne('App\ReviewDokManufaktur', 'id', 'review_dok_manufaktur_id')->first();
    }
}
