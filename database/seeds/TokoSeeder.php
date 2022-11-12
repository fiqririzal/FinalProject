<?php

use App\Toko;
use Illuminate\Database\Seeder;

class TokoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Toko::create([
            'id_user'  => 1,
            'name'     => 'Toko Pertama',
            'address'  => 'Indramayu',
            'phone'    => '0895152145',
            'image'    => '',
            'status'   => 'Aktif',
        ]);
    }
}
