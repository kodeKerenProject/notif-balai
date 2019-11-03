<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaporanHasilSertTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_hasil_sert', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('produk_id')->nullable();
            $table->string('shu')->nullable();
            $table->string('bapc')->nullable();
            $table->string('closed_ncr')->nullable();
            $table->unsignedBigInteger('doc_maker')->nullable();
            $table->string('laporan_hasil_sert')->nullable();
            $table->json('dok_lapSert')->nullable();
            $table->json('input_tt')->nullable();
            $table->json('input_evaluasi_tt')->nullable();
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
        Schema::dropIfExists('laporan_hasil_sert');
    }
}
