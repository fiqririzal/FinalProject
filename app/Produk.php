<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = "produk";

    protected $fillable = [
        'id_toko', 'name', 'detail', 'price', 'image', 'stok', 'created_at', 'updated_at',
    ];

    public function gabahToToko()
    {
        return $this->belongsTo(Toko::class, 'id_toko');
    }
}
