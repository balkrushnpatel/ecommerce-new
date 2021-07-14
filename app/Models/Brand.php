<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
   public function proBrand()
    {
        return $this->hasOne('App\Models\Product','brand_id');
    }
    protected static function boot(){
        parent::boot();  
        self::creating(function($brand){ 
            // produce a slug based on the activity title
            $slug = \Str::slug($brand->name);
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $brand->slug = $count ? "{$slug}-{$count}" : $slug;
        });

        self::created(function($query){
            // ... code here
        });

        self::updating(function($brand){
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
