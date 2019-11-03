<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTinjauanPpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tinjauan_pp', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('lengkap')->nullable();
            $table->string('struktur_organisasi')->nullable();
            $table->string('diagram_alir_produksi')->nullable();
            $table->string('daftar_peralatan')->nullable();
            $table->string('spesifikasi_peralatan')->nullable();
            $table->string('tata_letak_pabrik')->nullable();
            $table->string('peta_letak_pabrik_dari_bandara_terdekat')->nullable();
            // tambahan foreign key untuk table review
            $table->unsignedBigInteger('review_tinjauan_pp_id')->nullable();
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
        Schema::dropIfExists('tinjauan_pp');
    }
}
