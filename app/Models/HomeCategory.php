<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeCategory extends Model
{
    public function banner(){
        return $this->belongsTo('App\Models\Banner','banner_id');
    }
}
