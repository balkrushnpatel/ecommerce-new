<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     public function categories()
    {
        return $this->belongsTo('App\Models\Category','cat_id');
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand','brand_id');
    }
    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }
    public static function newArrival(){
        return self::where('status',1)->orderBy('id','DESC')->limit(10)->get();
    }
    public static function todayDeal(){
        return self::where('today_deal',1)->where('status',1)->get();
    }
    public static function feactureProduct(){
        return self::where('is_featured',1)->where('status',1)->get();
    }
    public function stockPro()
    {
        return $this->hasOne('App\Models\Productstock','product_id');
    }
    protected static function boot(){
        parent::boot();  
        self::creating(function($product){ 
            // produce a slug based on the activity title
            $slug = \Str::slug($product->name);
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $product->slug = $count ? "{$slug}-{$count}" : $slug;
        });

        self::created(function($query){
            // ... code here
        });

        self::updating(function($product){
            // produce a slug based on the activity title 
        });

        self::updated(function($query){
            // ... code here
        });

        self::deleting(function($query){
            // ... code here
        });

        self::deleted(function($query){
            // ... code here
        });

    } 
}
