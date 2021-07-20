<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    public static function getSetting($type){
    	$value = '';
    	if(!empty($type)){ 
    		$item =  self::where('type',$type)->first(); 
    		if(!empty($item->value)){
    			$value = $item->value;
    		}
    	}
    	return $value;
    }
}
