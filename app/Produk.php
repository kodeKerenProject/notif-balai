<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';

    public function user_r()
    {
    	return $this->belongsTo('App\User','id');
    }
}
