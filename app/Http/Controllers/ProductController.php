<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use DB;
use Session;
class ProductController extends Controller
{
  public function __construct(){
   
  }
  public function index(Request $request){
    try { 
      DB::beginTransaction(); 
    	$type = request()->segment(1);
      $id = request()->segment(2); 
    	$getProducts = Product::where('status',1);
    	$products = [];
    	if($type == 'product'){ 
        if(!empty($id)){
          if($id == 'search'){
            $name=$request->get('name');
            $getProducts = Product::where("name","LIKE","%{$name}%");
          }else if($id == 'today-deal'){
            $getProducts = Product::where("today_deal",1);
          }else if($id == 'featured'){
            $getProducts = Product::where("is_featured",1);
          }else if($id == 'classifieds'){
            $getProducts = Product::where("is_featured",1);
          }else{
            $reletedProduct = [];
            $getProducts = $getProducts->where('id',$id); 
            $products = $getProducts->get();
            if(count($products)){
              $catid = $products[0]->cat_id;
               $reletedProduct = Product::where('cat_id',$catid)->inRandomOrder()->get(); 
            }
            DB::commit();
            return view('user.product.detail',compact('products','reletedProduct')); 
          }  
        }
    	}else if($type == 'category'){
        if(!empty($id)){
          $getProducts = $getProducts->where('cat_id',$id);
        }else{
          return view('user.product.category');
        }
      }else if($type == 'subcategory'){
        if(!empty($id)){
          $getProducts = $getProducts->where('subcat_id',$id);
        }
      }else if($type == 'brand'){ 
        if(!empty($id)){
          $getProducts = $getProducts->where('brand_id',$id);
        }else{
          return view('user.product.brand');
        }
      }
      $products = $getProducts->get(); 
      DB::commit();
    	return view('user.product.list',compact('products')); 
    }catch (\Exception $e) {
        DB::rollback(); 
        return response()->json($e->getMessage());
    }
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
    try{
      DB::beginTransaction();
      $type = request()->segment(1);
      $id = request()->segment(2); 
      $getProducts = Product::where('status',1);
      $blog = [];
      if(!empty($id)){
        $getProducts = $getProducts->where('id',$id); 
        $blog = $getProducts->get(); 
        return view('user.blog.detail',compact('blog'));   
      }
      $blogs = $getProducts->get(); 
      DB::commit();
      return view('user.blog.list',compact('blogs'));
    }catch (\Exception $e) {
      DB::rollback(); 
      return response()->json($e->getMessage());
    } 
  } 

  public function compare()
  {
    $compare = session()->get('compare'); 
    $products=[];
    if(!empty($compare)){
      $products=Product::whereIn('id',$compare)->get();
    }  
    return view('user.product.compare',compact('products'));
  } 

  public function addToCompare(Request $request)
  {
    try{ 
        $id=$request->id; 
        //Session::forget('compare');
        $compare = session()->get('compare'); 
         $compare[$id] = $id;
        session()->put('compare',$compare); 
        return response()->json([
          'success' => true, 
          'compare' => session()->get('compare'), 
        ]); 
    }catch (\Exception $e) { 
      return response()->json($e->getMessage());
    }
   
  }

  public function quickView(Request $request){
   if($request->ajax()){
        try {    
          $id   = $request->get('id');
          $product=Product::where('id',$id)->first();
          return view('layouts.userpartials.product-quickview',compact('product'));
          
        }catch (\Exception $e) {
          return response()->json($e->getMessage());
        }
      } 
  }
  public  function removeProductCompare(Request $request)
  {
     if($request->ajax()){
        try {    
          $id   = $request->get('id');
          if($id==0){
                Session::forget('compare');
          }else{
            $compare = session()->get('compare');
            unset( $compare[$id]); 
            session()->put('compare',$compare);
            $products=Product::whereIn('id',$compare)->get();
            return view('user.product.compare-detail',compact('products'));
          }
        }catch (\Exception $e) {
          return response()->json($e->getMessage());
        }
      } 
  }
  
}
