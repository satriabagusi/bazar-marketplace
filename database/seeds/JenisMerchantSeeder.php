<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisMerchantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jenis_merchant')->insert([
            'nama_jenis_merchant' => 'Kuliner (Makanan dan Minuman)',
        ]);
        
        DB::table('jenis_merchant')->insert([
            'nama_jenis_merchant' => 'Fashion (Pakaian dan lainnya)',
        ]);

        DB::table('jenis_merchant')->insert([
            'nama_jenis_merchant' => 'Perlengkapan Rumah/Toko',
        ]);

        DB::table('jenis_merchant')->insert([
            'nama_jenis_merchant' => 'Multivitamin/Herbal/Kesehatan',
        ]);

        DB::table('jenis_merchant')->insert([
            'nama_jenis_merchant' => 'Hobby',
        ]);

        DB::table('jenis_merchant')->insert([
            'nama_jenis_merchant' => 'Lainnya',
        ]);
    }
}
