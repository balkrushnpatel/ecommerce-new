<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    public function blogCat()
    {
        return $this->belongsTo('App\Models\BlogCat','blog_cat_id');
    }

    protected static function boot(){
        parent::boot();  
        self::creating(function($blog){ 
            // produce a slug based on the activity title
            $slug = \Str::slug($blog->title);
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $blog->slug = $count ? "{$slug}-{$count}" : $slug;
        });

        self::created(function($query){
            // ... code here
        });

        self::updating(function($blog){
        });

        self::updated(function($blog){
            
        });

        self::deleting(function($query){
            // ... code here
        });

        self::deleted(function($query){
            // ... code here
        });

    } 
}
