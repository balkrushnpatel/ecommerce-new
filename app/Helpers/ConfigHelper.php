<?php
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\SubCategory;

if (! function_exists('getCategory')) {
  function getCategory() {
      $categories = Category::where('status', 1)->get();
      $category = [];
      foreach ($categories as $key => $item) {
        $subcategory = [];
        $brand = [];
        $sabcategories = SubCategory::where('cat_id', $item->id)->where('status', 1)->get();
        foreach ($sabcategories as $skey => $sitem) { 
            $brands = Brand::whereIn('id',json_decode($sitem->brand))->where('status', 1)->get();
            foreach ($brands as $bkey => $bitem) { 
            $image =  asset('uploads/noimage.jpg');
            $brandImage = public_path('uploads/brand/') . $bitem->image;
            if(file_exists($brandImage)){
              $image = asset('uploads/brand/'.$bitem->image);
            } 
            $brand[] = array(
              'id'=>$bitem->id,
              'name'=>$bitem->name, 
              'slug'=>$bitem->slug, 
              'image'=>$image, 
            );
          }
          $image =  asset('uploads/noimage.jpg');
          $subCategoryImage = public_path('uploads/sub_category/') . $sitem->image;
          if(file_exists($subCategoryImage)){
            $image = asset('uploads/sub_category/'.$sitem->image);
          }
          $subcategory[] = array(
            'id'=>$sitem->id,
            'name'=>$sitem->name,
            'slug'=>$sitem->slug,
            'image'=>$image,
            'brands'=>$brand,
          );
        }
        $image =  asset('uploads/noimage.jpg');
        $categoryImage = public_path('uploads/category/') . $item->image;
        if(file_exists($categoryImage)){
          $image = asset('uploads/category/'.$item->image);
        }
        $category[] = array(
          'id'=>$item->id,
          'name'=>$item->name,
          'slug'=>$item->slug,
          'image'=>$image,
          'subCategory'=>$subcategory,
        );
      }
      return $category;
  }
} 

if (! function_exists('getBrand')) {
    function getBrand() {
        $brand = Brand::where('status', 1)->pluck('name','id');
        return $brand;
    }
}

if (! function_exists('getSubCategory')) {
    function getSubCategory() {
        $product = SubCategory::where('status', 1)->pluck('name','id');
        return $product;
    }
}
if (! function_exists('isAdmin')) {
    function isAdmin() { 
        if(isset(auth()->user()->id)){
          $user_type = auth()->user()->hasRole('Admin'); 
         
          if($user_type){
              return true;
          }else{
              return false;
          }
        }else{
          return false;
        }
    }
}