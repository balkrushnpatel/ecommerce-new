<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
     public function category()
    {
        return $this->hasOne('App\Models\SubCategory','cat_id');
    }

    public function categories()
    {
        return $this->hasOne('App\Models\Product','cat_id');
    }

    public function stockCat()
    {
        return $this->hasOne('App\Models\Productstock','cat_id');
    }
    protected static function boot(){
        parent::boot();  
        self::creating(function($category){ 
            // produce a slug based on the activity title
            $slug = \Str::slug($category->name);
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $category->slug = $count ? "{$slug}-{$count}" : $slug;
        });

        self::created(function($query){
            // ... code here
        });

        self::updating(function($category){  
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
