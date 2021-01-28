<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(SuperUserSeeder::class);
        $this->call(KategoriPembeliSeeder::class);
        $this->call(KategoriPenjualSeeder::class);
        $this->call(JenisMerchantSeeder::class);
    }
}
