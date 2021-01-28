<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('nama_produk');
            $table->integer('stock');
            $table->integer('harga');
            $table->text('deskripsi');
            $table->unsignedBigInteger('id_jenis_merchant');
            $table->unsignedBigInteger('id_merchant');
            $table->timestamps();
        });

        Schema::table('produk', function (Blueprint $table){
            $table->foreign('id_jenis_merchant')->references('id')->on('jenis_merchant');
            $table->foreign('id_merchant')->references('id')->on('merchant');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produk');
    }
}
