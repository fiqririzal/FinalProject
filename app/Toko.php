<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    protected $table = "toko";

    protected $fillable = [
        'id_user', 'name', 'address', 'phone', 'image', 'status', 'created_at', 'updated_at',
    ];
    protected $appends = ['user_name'];

    public function getUserNameAttribute()
    {
        return User::where('id', $this->id_user)->value('name');
    }

    public function tokoToProduk()
    {
        return $this->hasMany(Produk::class, 'id_toko');
    }

    public function tokoToUser()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
