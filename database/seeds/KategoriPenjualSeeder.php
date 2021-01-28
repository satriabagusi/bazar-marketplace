<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriPenjualSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategori_merchant')->insert([
            'nama_kategori_merchant' => 'Pekerja',
        ]);
        
        DB::table('kategori_merchant')->insert([
            'nama_kategori_merchant' => 'Keluarga Pekerja',
        ]);

        DB::table('kategori_merchant')->insert([
            'nama_kategori_merchant' => 'UMKM Sekitar Bumi Patra dan RU VI',
        ]);

        DB::table('kategori_merchant')->insert([
            'nama_kategori_merchant' => 'Mitra Binaan CSR',
        ]);
    }
}
