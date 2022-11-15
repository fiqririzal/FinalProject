<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = "article";

    protected $fillable = [
        'id_category', 'title','slug','body','image','author'
    ];
    public function Category() {
        return $this->belongsTo(Category::class, 'id_category','id');
    }

}
