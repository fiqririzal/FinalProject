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
        $this->call([
            AuthSeeder::class,
            UserSeeder::class,
            // PabrikSeeder::class,
            // TokoSeeder::class,
            // ProdukSeeder::class,
            // GabahSeeder::class,
        ]);
    }
}
