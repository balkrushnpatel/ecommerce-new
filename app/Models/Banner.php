<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    public function banner(){
        return $this->hasOne('App\Models\HomeCategory','banner_id');
    }
}
