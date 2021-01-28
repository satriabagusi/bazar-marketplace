<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SuperUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('superuser')->insert([
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('bazokaaamarketplace'),
            'no_hp_superuser' => '085974212652',
            'nama' => 'Admin Superuser',
        ]);
    }
}
