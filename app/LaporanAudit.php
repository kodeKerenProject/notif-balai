<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaporanAudit extends Model
{
    protected $table = 'laporan_audit';

    public function jadwal_audit() {
    	return $this->hasOne('App\JadwalAudit', 'id');
    }
}
