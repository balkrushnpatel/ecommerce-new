<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Productstock extends Model
{
    public function stockPro()
    {
        return $this->belongsTo('App\Models\Product','product_id');
    }

     public function stockCat()
    {
        return $this->belongsTo('App\Models\Category','cat_id');
    }

    public function stockSubCat()
    {
        return $this->belongsTo('App\Models\SubCategory','subcat_id');
    }
}
