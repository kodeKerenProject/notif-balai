<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TinjauanPP extends Model
{
    protected $table = 'tinjauan_pp';

    public function getReview() {
    	return $this->hasOne('App\ReviewTinjauanPP', 'id', 'review_tinjauan_pp_id')->first();
    }
}
