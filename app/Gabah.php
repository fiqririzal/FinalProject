<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gabah extends Model
{
    protected $table = "gabah";

    protected $fillable = [
        'id_pabrik', 'name', 'detail', 'price', 'image', 'created_at', 'updated_at',
    ];

    public function gabahToPabrik()
    {
        return $this->belongsTo(Pabrik::class, 'id_pabrik');
    }
}
