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

        // Table Relations
        Schema::table('users', function(Blueprint $table) {
            $table->foreign('role_id')->references('id')->on('role')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('persyaratan_dok_dalam_negeri', function(Blueprint $table) {
            $table->foreign('produk_id')->references('id')->on('produk')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('persyaratan_dok_luar_negeri', function(Blueprint $table) {
            $table->foreign('produk_id')->references('id')->on('produk')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('persyaratan_dok_luar_negeri', function(Blueprint $table) {
            $table->foreign('dok_importir_id')->references('id')->on('dok_importir')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('persyaratan_dok_luar_negeri', function(Blueprint $table) {
            $table->foreign('dok_manufaktur_id')->references('id')->on('dok_manufaktur')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('dok_importir', function(Blueprint $table) {
            $table->foreign('persyaratan_dok_dalam_negeri_id')->references('id')->on('persyaratan_dok_dalam_negeri')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('notif_log', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });


        Schema::table('laporan_audit', function(Blueprint $table) {
            $table->foreign('produk_id')->references('id')->on('produk')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('laporan_audit', function(Blueprint $table) {
            $table->foreign('auditor')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });


        Schema::table('audit_sampling_plan', function(Blueprint $table) {
            $table->foreign('produk_id')->references('id')->on('produk')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('audit_sampling_plan', function(Blueprint $table) {
            $table->foreign('doc_maker')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('produk', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('produk', function(Blueprint $table) {
            $table->foreign('sert_id')->references('id')->on('sert')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('mou', function(Blueprint $table) {
            $table->foreign('produk_id')->references('id')->on('produk')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('mou', function(Blueprint $table) {
            $table->foreign('doc_maker')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('bid_price', function(Blueprint $table) {
            $table->foreign('produk_id')->references('id')->on('produk')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('bid_price', function(Blueprint $table) {
            $table->foreign('doc_maker')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('bid_price', function(Blueprint $table) {
            $table->foreign('invoice_id')->references('id')->on('invoice')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('invoice', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('laporan_hasil_sert', function(Blueprint $table) {
            $table->foreign('produk_id')->references('id')->on('produk')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('laporan_hasil_sert', function(Blueprint $table) {
            $table->foreign('doc_maker')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('laporan_audit', function(Blueprint $table) {
            $table->foreign('jadwal_audit_id')->references('id')->on('jadwal_audit')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('jadwal_audit', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('tinjauan_pp', function(Blueprint $table) {
            $table->foreign('review_tinjauan_pp_id')->references('id')->on('review_tinjauan_pp')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('dok_manufaktur', function(Blueprint $table) {
            $table->foreign('review_dok_manufaktur_id')->references('id')->on('review_dok_manufaktur')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('dok_importir', function(Blueprint $table) {
            $table->foreign('review_dok_importir_id')->references('id')->on('review_dok_importir')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('laporan_audit', function(Blueprint $table) {
            $table->foreign('dok_importir_id')->references('id')->on('dok_importir')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('laporan_audit', function(Blueprint $table) {
            $table->foreign('dok_manufaktur_id')->references('id')->on('dok_manufaktur')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('laporan_audit', function(Blueprint $table) {
            $table->foreign('tinjauan_pp_id')->references('id')->on('tinjauan_pp')->onDelete('cascade')->onUpdate('cascade');
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
