<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('role_id')->nullable();
            $table->string('negeri')->nullable();
            $table->string('nama_perusahaan');
            $table->string('pimpinan_perusahaan');
            $table->text('alamat_perusahaan');
            $table->string('kota');
            $table->string('provinsi');
            $table->string('kode_pos');
            $table->string('no_telp');
            $table->string('no_fax');
            $table->string('email_pengguna');
            $table->text('alamat_pabrik');
            $table->string('telp_pabrik');
            $table->string('fax_pabrik');
            $table->string('email_perusahaan');
            $table->string('jml_pegawai_tetap');
            $table->string('jml_pegawai_tidak_tetap');
            $table->string('jml_line_produksi');
            $table->string('contact_person');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
