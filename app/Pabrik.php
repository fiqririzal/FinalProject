<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pabrik extends Model
{
    protected $table = "pabrik";

    protected $fillable = [
        'id_user', 'name', 'address', 'phone', 'image', 'status', 'created_at', 'updated_at',
    ];

    public function pabrikToUser()
    {
        return $this->belongsTo(Toko::class, 'id_user');
    }
}
