<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_transaksi');
            $table->string('bukti_transfer')->nullable();
            $table->string('bukti_pengiriman')->nullable();
            $table->text('pesan')->nullable();
            $table->integer('status_transaksi');
            $table->integer('total_produk');
            $table->integer('total_transaksi');
            $table->unsignedBigInteger('id_produk');
            $table->unsignedBigInteger('id_pembeli');
            $table->unsignedBigInteger('id_merchant');
            $table->timestamps();
        });

        Schema::table('transaksi', function (Blueprint $table){
            $table->foreign('id_produk')->references('id')->on('produk');
            $table->foreign('id_pembeli')->references('id')->on('pembeli');
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
        Schema::dropIfExists('transaksi');
    }
}
