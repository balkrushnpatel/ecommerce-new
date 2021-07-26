<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    public function wishlist() {
        return $this->belongsTo('App\Models\Product','product_id')->where('user_id',auth()->user()->id);
    }
}
