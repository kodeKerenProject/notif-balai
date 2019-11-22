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
            $table->string('nama_perusahaan')->nullable();
            $table->string('pimpinan_perusahaan')->nullable();
            $table->text('alamat_perusahaan')->nullable();
            $table->string('kota')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('no_fax')->nullable();
            $table->string('email_pengguna')->nullable();
            $table->text('alamat_pabrik')->nullable();
            $table->string('telp_pabrik')->nullable();
            $table->string('fax_pabrik')->nullable();
            $table->string('email_perusahaan')->nullable();
            $table->string('jml_pegawai_tetap')->nullable();
            $table->string('jml_pegawai_tidak_tetap')->nullable();
            $table->string('jml_line_produksi')->nullable();
            $table->string('contact_person')->nullable();
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
