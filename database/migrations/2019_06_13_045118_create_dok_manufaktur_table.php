<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDokManufakturTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('dok_manufaktur', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->integer('lengkap')->nullable();
        //     $table->string('surat_permohonan_dari_manufaktur')->nullable();
        //     $table->string('daftar_isian_dan_kuesioner_manufaktur')->nullable();
        //     $table->string('izin_usaha_manufaktur')->nullable();
        //     $table->string('sert_iso_9001')->nullable();
        //     $table->string('laporan_pengawasan_iso_9001_terakhir')->nullable();
        //     $table->string('struktur_organisasi')->nullable();
        //     $table->string('diagram_alir_produksi')->nullable();
        //     $table->string('panduan_mutu')->nullable();
        //     $table->string('daftar_induk_dok')->nullable();
        //     $table->string('surat_penunjukkan_wakil_manajemen')->nullable();
        //     $table->string('tata_letak_pabrik')->nullable();
        //     $table->string('peta_rute_pabrik_dari_bandara_terdekat')->nullable();
        //     // tambahan foreign key untuk table review
        //     $table->unsignedBigInteger('review_dok_manufaktur_id')->nullable();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('dok_manufaktur');
    }
}
