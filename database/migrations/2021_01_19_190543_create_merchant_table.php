<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('acc_status')->default(0);
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->char('no_hp_merchant', 14);
            $table->text('alamat');
            $table->integer('point_merchant')->default(0);
            $table->integer('point_merchant_pending')->default(0);
            $table->text('nama_merchant');
            $table->text('nama_pemilik_merchant');
            $table->unsignedBigInteger('id_kategori_merchant');
            $table->unsignedBigInteger('id_jenis_merchant');
            $table->timestamps();
        });

        Schema::table('merchant', function (Blueprint $table){
            $table->foreign('id_kategori_merchant')->references('id')->on('kategori_merchant');
            $table->foreign('id_jenis_merchant')->references('id')->on('jenis_merchant');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchant');
    }
}
