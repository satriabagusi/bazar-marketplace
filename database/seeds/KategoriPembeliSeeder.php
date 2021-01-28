<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriPembeliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategori_pembeli')->insert([
            'nama_kategori_pembeli' => 'Pekerja',
        ]);

        DB::table('kategori_pembeli')->insert([
            'nama_kategori_pembeli' => 'Keluarga Pekerja',
        ]);

        DB::table('kategori_pembeli')->insert([
            'nama_kategori_pembeli' => 'Mitra Pekerja',
        ]);
    }
}
