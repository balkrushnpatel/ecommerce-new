<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Couponcode extends Model
{
    public static  function getCoupon($code){
    	$coupon = self::where('code',$code)->where('status',1)->first();
    	return $coupon;
    }
}
