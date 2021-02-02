<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKuponPembeliTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kupon_pembeli', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_kupon');
            $table->unsignedBigInteger('id_pembeli');
            $table->unsignedBigInteger('id_jenis_kupon');
            $table->timestamps();
        });

        Schema::table('kupon_pembeli', function (Blueprint $table){
            $table->foreign('id_jenis_kupon')->references('id')->on('jenis_kupon_pembeli');
            $table->foreign('id_pembeli')->references('id')->on('pembeli');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kupon_pembeli');
    }
}
