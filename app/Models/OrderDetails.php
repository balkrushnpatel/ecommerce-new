<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    public static function getOrderId()
    {   
        $newId = 0;
        $item = self::orderBy('id', 'DESC');
        if($item->count() >= 1){
            $item = $item->first()->order_id; 
            $newId   =  $item+1; 
        }else{
            $newId =  '10801'; 
        }
        return $newId;
    }

    protected static function boot()
    {
        parent::boot();  
        self::creating(function($query){
           $query->order_id = self::getOrderId(); 
        });

        self::created(function($query){
            // ... code here
        });

        self::updating(function($query){
            // ... code here
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
