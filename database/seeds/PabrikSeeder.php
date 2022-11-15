<?php

use App\Pabrik;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class PabrikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pabrik::create([
            'id_user'  => 1,
            'name'     => 'Pabrik Pertama',
            'address'  => 'Indramayu',
            'phone'    => '0895152145',
            'image'    => '',
            'status'   => 'Aktif',
        ]);
    }
}
