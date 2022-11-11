<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = "produk";

    protected $fillable = [
        'id_toko', 'name', 'detail', 'price', 'image', 'stok', 'created_at', 'updated_at',
    ];
    protected $appends = ['toko_name'];

    public function getTokoNameAttribute()
    {
        return Toko::where('id', $this->id_toko)->value('name');
    }

    public function produkToToko()
    {
        return $this->belongsTo(Toko::class, 'id_toko');
    }
}
