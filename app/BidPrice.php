<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BidPrice extends Model
{
    protected $table = 'bid_price';

    public function invoice() {
    	return $this->hasOne('App\Invoice', 'id');
    }
}
