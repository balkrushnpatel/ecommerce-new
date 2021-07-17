<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    public function blogCat()
    {
        return $this->belongsTo('App\Models\BlogCat','blog_cat_id');
    }
}
