<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Str;
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
    public static function getSingleProduct($id){
        return self::where('id',$id)->where('status',1)->first();
    }
    public function stockPro()
    {
        return $this->hasOne('App\Models\Productstock','product_id');
    }
    public function productPrice(){
        return '<i class="fa fa-inr"></i> '.$this->price;
    }
    public function mainPrice(){
          $discount_type=$this->discount_type;
          if($discount_type=='1')
          {
             $mainprice=($this->price)+($this->discount);

          }else{
              $price=($this->price)*($this->discount)/100;
              $mainprice=($this->price)+$price;
          } 

          return '<i class="fa fa-inr"></i> '.$mainprice;
    }
    public function productSlug(){
        return route('product.detail',array('id' => $this->id, 'slug' => Str::slug($this->slug)));
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
