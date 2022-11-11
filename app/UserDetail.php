<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $table = "userdetail";

    protected $fillable =[
    'user_id','address','phone','hobby','role'
    ];
}
// ,'photo_profile','photo_id',
//
