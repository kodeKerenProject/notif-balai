<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersyaratanDokDalamNegeriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persyaratan_dok_dalam_negeri', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('produk_id')->nullable();
            $table->string('sni')->nullable();
            $table->string('surat_permohonan_sertifikat_sni')->nullable();
            // $table->string('daftar_isian_kuesioner')->nullable();
            $table->string('copy_iui')->nullable();
            $table->string('copy_akte_notaris_perusahaan')->nullable();
            $table->string('copy_tdp')->nullable();
            $table->string('copy_npwp')->nullable();
            $table->string('copy_sert_patent_merek')->nullable();
            $table->string('copy_sert_iso_9001')->nullable();
            $table->string('laporan_audit_sistem_mutu_terakhir')->nullable();
            $table->string('panduan_mutu')->nullable();
            $table->string('daftar_induk_dok')->nullable();
            $table->string('struktur_organisasi')->nullable();
            $table->string('diagram_alir_proses_produksi')->nullable();
            $table->string('surat_pertunjukkan_wakil_manajemen')->nullable();
            $table->string('ilustrasi_pembubuhan_tanda_sni')->nullable();
            $table->string('tabel_daftar_tipe_produk')->nullable();
            $table->string('gambar_dan_spesifikasi_produk')->nullable();
            $table->string('tata_letak_pabrik')->nullable();
            $table->string('peta_rute_pabrik_dari_bandara_terdekat')->nullable();
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
        Schema::dropIfExists('persyaratan_dok_dalam_negeri');
    }
}
