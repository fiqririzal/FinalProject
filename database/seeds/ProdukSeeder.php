<?php

use App\Produk;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Produk::create([
            'id_toko' => 1,
            'name'    => 'Produk Pertama',
            'detail'  => 'Detail Produk Pertama',
            'price'   => 500000,
            'image'   => '',
            'stok'    => 5,
        ]);
    }
}
