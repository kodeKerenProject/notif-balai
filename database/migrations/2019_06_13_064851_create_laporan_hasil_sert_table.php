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
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('shu');
            $table->string('bapc');
            $table->string('closed_ncr');
            $table->unsignedBigInteger('laporan_hasil_sert_maker_id')->nullable();
            $table->string('laporan_hasil_sert')->nullable();
            $table->string('input_tt')->nullable();
            $table->string('input_evaluasi_tt')->nullable();
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
