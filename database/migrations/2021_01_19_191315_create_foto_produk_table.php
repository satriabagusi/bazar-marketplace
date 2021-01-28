<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFotoProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foto_produk', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('url_foto');
            $table->unsignedBigInteger('id_produk');
            $table->timestamps();
        });

        Schema::table('foto_produk', function (Blueprint $table) {
            $table->foreign('id_produk')->references('id')->on('produk')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foto_produk');
    }
}
