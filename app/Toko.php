<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    protected $table = "toko";

    protected $fillable = [
        'id_user', 'name', 'address', 'phone', 'image', 'status', 'created_at', 'updated_at',
    ];

    public function tokoToUser()
    {
        return $this->belongsTo(Toko::class, 'id_user');
    }
}
