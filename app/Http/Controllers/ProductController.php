<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use DB;
class ProductController extends Controller
{
  public function __construct(){
   
  }
  public function index(Request $request){
  	$type = request()->segment(1);
    $id = request()->segment(2); 
  	$getProducts = Product::where('status',1);
  	$products = [];
  	if($type == 'product'){ 
      if(!empty($id)){
        if($id == 'search')
        {
             $name=$request->get('name');
             $getProducts = Product::where("name","LIKE","%{$name}%");
        }else{
        $getProducts = $getProducts->where('id',$id); 
        $products = $getProducts->get();
        return view('user.product.detail',compact('products')); }  
      }

  	}else if($type == 'category'){
      if(!empty($id)){
        $getProducts = $getProducts->where('cat_id',$id);    
      }
    }else if($type == 'subcategory'){
      if(!empty($id)){
        $getProducts = $getProducts->where('subcat_id',$id);    
      }
    }else if($type == 'brand'){
      if(!empty($id)){
        $getProducts = $getProducts->where('brand_id',$id);    
      }
    }
    $products = $getProducts->get(); 
  	return view('user.product.list',compact('products')); 
  }
  public function productFilter(Request $request){
    if($request->ajax()){
      try {  
          DB::beginTransaction();
          $filter = $request->filter;
          $category_id = $request->category_id;
          $price = $request->price;
          $getProducts = Product::where('status',1);
          if(!empty($category_id)){
            $getProducts = $getProducts->where('cat_id',$category_id);
          }
          if(!empty($price)){
            $expPrice = explode('-',$price); 
            if(empty($expPrice[1])){ 
              $getProducts = $getProducts->where('price','>=',$price);
            }else{ 
              $getProducts = $getProducts->where('price','>=',$expPrice[0])->where('price','<=',$expPrice[1]);
            }
          }
          if($filter == 'popularity'){
            $getProducts = $getProducts->orderByRaw('RAND()'); 
          }else if($filter == 'date'){
            $getProducts = $getProducts->orderBy('id','DESC'); 
          }else if($filter == 'rating'){
            $getProducts = $getProducts->orderByRaw('RAND()'); 
          }else if($filter == 'price-low'){ 
            $getProducts = $getProducts->orderBy('price','ASC'); 
          }else if($filter == 'price-high'){
            $getProducts = $getProducts->orderBy('price','DESC'); 
          }
          $data['products'] = $getProducts->get();  
          DB::commit();
          return view('user.product.product-list', $data);
      }catch (\Exception $e) {
          DB::rollback(); 
          return response()->json($e->getMessage());
      } 
  }else{
      return abort(404);
  }
  }
  public function blogs(Request $request){
    $type = request()->segment(1);
    $id = request()->segment(2); 
    $getProducts = Product::where('status',1);
    $blog = [];
    if(!empty($id)){
      $getProducts = $getProducts->where('id',$id); 
      $blog = $getProducts->get(); 
      return view('user.product.detail',compact('blog'));   
    }
    $blog = $getProducts->get(); 
    return view('user.blog.list',compact('blog')); 
  }
}
