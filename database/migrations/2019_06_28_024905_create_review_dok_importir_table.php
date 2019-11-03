<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewDokImportirTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_dok_luar_negeri', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->string('surat_permohonan_sertifikat_sni')->nullable();
            // $table->string('daftar_isian_dan_kuesioner_importer')->nullable();
            // $table->string('copy_iui')->nullable();
            // $table->string('copy_akte_notaris_perusahaan')->nullable();
            // $table->string('copy_npwp')->nullable();
            // $table->string('copy_tdp')->nullable();
            // $table->string('copy_api')->nullable();
            // $table->string('copy_sert_patent_merek')->nullable();
            // $table->string('penunjukkan_distributor')->nullable();
            // $table->string('struktur_organisasi')->nullable();
            // $table->string('ilustrasi_pembubuhan_tanda_sni')->nullable();
            // $table->string('tabel_daftar_tipe_produk')->nullable();
            // $table->string('gambar_dan_spesifikasi_produk')->nullable();
            // $table->string('sert_smm')->nullable();
            // $table->string('laporan_pengawasan_iso_9001_terakhir')->nullable();
            // $table->timestamps();

            // importir
            $table->string('surat_permohonan_importer')->nullable();
            $table->integer('lengkap')->nullable();
            $table->string('daftar_isian_dan_kuesioner_importer')->nullable();
            $table->string('copy_iui')->nullable();
            $table->string('copy_akte_notaris_perusahaan')->nullable();
            $table->string('copy_npwp')->nullable();
            $table->string('copy_tdp')->nullable();
            $table->string('copy_api')->nullable();
            $table->string('copy_sert_patent_merek')->nullable();
            $table->string('penunjukkan_distributor')->nullable();
            // $table->string('struktur_organisasi')->nullable();
            $table->string('ilustrasi_pembubuhan_tanda_sni')->nullable();
            $table->string('tabel_daftar_tipe_produk')->nullable();
            $table->string('gambar_dan_spesifikasi_produk')->nullable();
            $table->string('sert_smm')->nullable();
            // $table->string('laporan_pengawasan_iso_9001_terakhir')->nullable();

            // manufaktur
            $table->string('surat_permohonan_dari_manufaktur')->nullable();
            $table->string('daftar_isian_dan_kuesioner_manufaktur')->nullable();
            $table->string('izin_usaha_manufaktur')->nullable();
            $table->string('sert_iso_9001')->nullable();
            $table->string('laporan_pengawasan_iso_9001_terakhir')->nullable();
            $table->string('struktur_organisasi')->nullable();
            $table->string('diagram_alir_produksi')->nullable();
            $table->string('panduan_mutu')->nullable();
            $table->string('daftar_induk_dok')->nullable();
            $table->string('surat_penunjukkan_wakil_manajemen')->nullable();
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
        Schema::dropIfExists('review_dok_luar_negeri');
    }
}
