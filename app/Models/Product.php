<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     public function categories()
    {
        return $this->belongsTo('App\Models\Category','cat_id');
    }

    public function proBrand()
    {
        return $this->belongsTo('App\Models\Brand','brand_id');
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
