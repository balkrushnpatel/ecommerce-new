<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    public function wishlist() {
        return $this->belongsTo('App\Models\Product','product_id')->where('user_id',auth()->user()->id);
    }
    public function product() {
        return $this->belongsTo('App\Models\Product','product_id');
    }
    public function userWishlist() {
        return $this->belongsTo('App\User','user_id');
    }
}
