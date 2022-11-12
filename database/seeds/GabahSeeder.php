<?php

use App\Gabah;
use Illuminate\Database\Seeder;

class GabahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gabah::create([
            'id_pabrik' => 1,
            'name'    => 'Gabah Pertama',
            'detail'  => 'Detail Gabah Pertama',
            'price'   => 5000000,
            'image'   => '',
        ]);
    }
}
