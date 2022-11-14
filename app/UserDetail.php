<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $table = "userdetail";

    protected $fillable =[
    'id_user','address','phone','hobby','role','photo_profile','photo_id'
    ];
}
// ,'photo_profile','photo_id',
//
