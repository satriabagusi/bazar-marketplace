<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKuponMerchantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kupon_merchant', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_voucher');
            $table->unsignedBigInteger('id_merchant');
            $table->timestamps();
        });

        Schema::table('kupon_merchant', function (Blueprint $table){
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
        Schema::dropIfExists('kupon_merchant');
    }
}
