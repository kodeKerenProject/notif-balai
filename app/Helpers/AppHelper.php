<?php

namespace App\Helpers;

use \App\TahapSert;

/**
* AppHelper berisi beberapa global functions
*/
class AppHelper
{
	public static function instance() {
    	return new AppHelper();
    }

    public function tahap($id) {
    	return TahapSert::where('produk_id', $id)->first();
    }
}