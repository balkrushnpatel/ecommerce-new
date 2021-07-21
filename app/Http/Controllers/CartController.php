<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use DB;

class CartController extends Controller
{
    public function __construct(){
   
  	}
  	public function addToCart(Request $request){
  		if($request->ajax()){
	      	try {   
	          	$option = $request->get('option');
	          	$color  = $request->get('color');
	          	$id     = $request->get('id');
	          	$qty    = $request->get('qty');
	          	$product = Product::getSingleProduct($id); 
	          	$isCart = true;
		      	$cart[$id] = [
					"id"   =>$product->id,
					"name" => $product->name,
					"option" => $option,
					"color" => $color,
					"description" => $product->description,
					"quantity" => $qty,
					"image"=>$product->image,
					"price" => $product->price,
					"total_price" => ($product->price * $qty),
					"image" => fileView($product,'thumb','no','jpg','src'),
					"url" => $product->productSlug(),
				];
		      	session()->put('cart', $cart); 
		      	return response()->json([
                    'success' => true, 
                ]); 
	        }catch (\Exception $e) { 
		        return response()->json($e->getMessage());
    		}
    	}
  	}
  	public function removeProductCart(Request $request){
  		if($request->ajax()){
	      	try {    
	          	$id     = $request->get('id');
	          	$cart = session()->get('cart');
		      	if(isset($cart[$id])){
			        unset($cart[$id]);
			        session()->put('cart', $cart);
			    }
		      	return response()->json([
                    'success' => true, 
                    'message' => 'Product removed from cart', 
                ]); 
	        }catch (\Exception $e) { 
		        return response()->json($e->getMessage());
    		}
    	}
  	}
  	public function headerCart(Request $request){
  		if($request->ajax()){
	      	try {   
	          	return view('user.checkout.header-cart');
	        }catch (\Exception $e) { 
		        return response()->json($e->getMessage());
    		}
    	}
  	}
}
