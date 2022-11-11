<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $fillable =[
    'id_user','address','phone','hobby','photo_profile','photo_id','role'
    ];
}
