<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('produk');
            $table->unsignedBigInteger('sert_id')->nullable();
            $table->string('draft_sert')->nullable();
            $table->integer('status_sert_jadi')->nullable();
            $table->string('request_sert')->nullable();
            $table->string('tgl_request_sert')->nullable();
            $table->string('resi_pengiriman')->nullable();
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
        Schema::dropIfExists('produk');
    }
}
