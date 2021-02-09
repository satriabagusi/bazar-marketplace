<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembeliTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembeli', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username')->unique();
            $table->integer('nomor_pekerja');
            $table->string('fungsi');
            $table->string('bagian');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('nama_pembeli');
            $table->char('no_hp_pembeli', 14);
            $table->text('alamat');
            $table->integer('point_pembeli')->default(0);
            $table->integer('point_pembeli_pending')->default(0);
            $table->unsignedBigInteger('id_kategori_pembeli');
            $table->timestamps();
        });

        Schema::table('pembeli', function (Blueprint $table){
            $table->foreign('id_kategori_pembeli')->references('id')->on('kategori_pembeli');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembeli');
    }
}
