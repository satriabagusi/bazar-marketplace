<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisKuponPembeliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jenis_kupon_pembeli')->insert([
            'deskripsi' => 'Doorprize Hiburan',
            'poin' => 30
        ]);
        DB::table('jenis_kupon_pembeli')->insert([
            'deskripsi' => 'Doorprize ke-5',
            'poin' => 60,
        ]);
        DB::table('jenis_kupon_pembeli')->insert([
            'deskripsi' => 'Doorprize ke-4',
            'poin' => 70,
        ]);
        DB::table('jenis_kupon_pembeli')->insert([
            'deskripsi' => 'Doorprize ke-3',
            'poin' => 80,
        ]);
        DB::table('jenis_kupon_pembeli')->insert([
            'deskripsi' => 'Doorprize ke-2',
            'poin' => 90,
        ]);
        DB::table('jenis_kupon_pembeli')->insert([
            'deskripsi' => 'Doorprize UTAMA',
            'poin' => 100,
        ]);
    }
}
