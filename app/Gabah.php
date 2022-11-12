<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gabah extends Model
{
    protected $table = "gabah";

    protected $fillable = [
        'id_pabrik', 'name', 'detail', 'price', 'image', 'created_at', 'updated_at',
    ];
    protected $appends = ['pabrik_name'];

    public function getPabrikNameAttribute()
    {
        return Pabrik::where('id', $this->id_pabrik)->value('name');
    }

    public function gabahToPabrik()
    {
        return $this->belongsTo(Pabrik::class, 'id_pabrik');
    }
}
