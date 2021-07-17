<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCat extends Model
{
   public function blogCat()
    {
        return $this->hasOne('App\Models\Blog','blog_cat_id');
    }
}
