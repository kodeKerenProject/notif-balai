<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaporanHasilSertMakerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_hasil_sert_maker', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
        });


        // Table Relations
        Schema::table('users', function(Blueprint $table) {
            $table->foreign('role_id')->references('id')->on('role')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('persyaratan_dok_dalam_negeri', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('persyaratan_dok_luar_negeri', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('notif_log', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('dok_importir', function(Blueprint $table) {
            $table->foreign('persyaratan_dok_luar_negeri_id')->references('id')->on('persyaratan_dok_luar_negeri')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('laporan_audit', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('laporan_audit', function(Blueprint $table) {
            $table->foreign('laporan_audit_maker_id')->references('id')->on('laporan_audit')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('laporan_audit', function(Blueprint $table) {
            $table->foreign('tinjauan_pp_id')->references('id')->on('tinjauan_pp')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('laporan_audit_maker', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('audit_sampling_plan', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('audit_sampling_plan', function(Blueprint $table) {
            $table->foreign('audit_sampling_plan_maker_id')->references('id')->on('audit_sampling_plan_maker')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('audit_sampling_plan_maker', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('produk', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('produk', function(Blueprint $table) {
            $table->foreign('sert_id')->references('id')->on('sert')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('mou', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('mou', function(Blueprint $table) {
            $table->foreign('mou_maker_id')->references('id')->on('mou_maker')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('mou_maker', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('bid_price', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('bid_price', function(Blueprint $table) {
            $table->foreign('bid_price_maker_id')->references('id')->on('bid_price_maker')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('bid_price', function(Blueprint $table) {
            $table->foreign('invoice_id')->references('id')->on('invoice')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('bid_price_maker', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('invoice', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('laporan_hasil_sert', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('laporan_hasil_sert', function(Blueprint $table) {
            $table->foreign('laporan_hasil_sert_maker_id')->references('id')->on('laporan_hasil_sert_maker')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('laporan_hasil_sert_maker', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('laporan_hasil_sert_maker');
    }
}
