<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pabrik extends Model
{
    protected $table = "pabrik";

    protected $fillable = [
        'id_user', 'name', 'address', 'phone', 'image', 'status', 'created_at', 'updated_at',
    ];
    protected $appends = ['user_name'];

    public function getUserNameAttribute()
    {
        return User::where('id', $this->id_user)->value('name');
    }

    public function pabrikToUser()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
