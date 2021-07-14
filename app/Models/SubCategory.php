<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
     public function category()
    {
        return $this->belongsTo('App\Models\Category','cat_id');
    }

    public function stockSubCat()
    {
        return $this->hasOne('App\Models\Productstock','subcat_id');
    }
    protected static function boot(){
        parent::boot();  
        self::creating(function($subcategory){ 
            // produce a slug based on the activity title
            $slug = \Str::slug($subcategory->name);
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $subcategory->slug = $count ? "{$slug}-{$count}" : $slug;
        });

        self::created(function($query){
            // ... code here
        });

        self::updating(function($subcategory){
            
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
