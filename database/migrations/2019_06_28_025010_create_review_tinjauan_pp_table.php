<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewTinjauanPpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_tinjauan_pp', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('struktur_organisasi')->nullable();
            $table->string('diagram_alir_produksi')->nullable();
            $table->string('daftar_peralatan')->nullable();
            $table->string('spesifikasi_peralatan')->nullable();
            $table->string('tata_letak_pabrik')->nullable();
            $table->string('peta_letak_pabrik_dari_bandara_terdekat')->nullable();
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
        Schema::dropIfExists('review_tinjauan_pp');
    }
}
