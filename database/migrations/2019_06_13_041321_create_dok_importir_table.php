<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDokImportirTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dok_importir', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('surat_permohonan_importer')->nullable();
            $table->string('daftar_isian_dan_kuesioner_importer')->nullable();
            $table->string('copy_iui')->nullable();
            $table->string('copy_akte_notaris_perusahaan')->nullable();
            $table->string('copy_npwp')->nullable();
            $table->string('copy_api')->nullable();
            $table->string('copy_sert_patent_merek')->nullable();
            $table->string('penunjukkan_distributor')->nullable();
            $table->string('struktur_organisasi')->nullable();
            $table->string('ilustrasi_pembubuhan_tanda_sni')->nullable();
            $table->string('tabel_daftar_tipe_produk')->nullable();
            $table->string('gambar_dan_spesifikasi_produk')->nullable();
            $table->string('sert_smm')->nullable();
            $table->string('laporan_pengawasan_iso_9001_terakhir')->nullable();
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
        Schema::dropIfExists('dok_importir');
    }
}
