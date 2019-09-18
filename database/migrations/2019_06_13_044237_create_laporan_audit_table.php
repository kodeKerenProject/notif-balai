<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaporanAuditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_audit', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('produk_id')->nullable();
            $table->unsignedBigInteger('auditor')->nullable();
            $table->unsignedBigInteger('persyaratan_dok_luar_negeri_id')->nullable();
            // $table->unsignedBigInteger('dok_importir_id')->nullable();
            // $table->unsignedBigInteger('dok_manufaktur_id')->nullable();
            $table->unsignedBigInteger('tinjauan_pp_id')->nullable();
            $table->unsignedBigInteger('jadwal_audit_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('laporan_audit');
    }
}
