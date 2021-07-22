<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Couponcode;
use App\Models\OrderDetails;
use DB;
use Session;
class CartController extends Controller{
    public function __construct(){
  	}
    public function index(){
      return view('user.checkout.cart');
    }
    public function checkout(Request $request){
    	$priceArr = array(
    		'shipping_cost'=>$request->input('shipping'),
    		'final_total'=>$request->input('final_total'),
    		'discount'=>$request->input('discount'),
    		'discount_type'=>$request->input('discount_type'),
    		'total'=>$request->input('total'),
    	);
    	session()->put($priceArr); 
	    return view('user.checkout.checkout ');
    }
    public function placeOrder(Request $request){
    	try {   
    		 DB::beginTransaction();
	    	$payment_type= '1';
	    	$orderdetails =new OrderDetails();  
		    $orderdetails->shipping_info = json_encode($request->input('shipping_info'));
		    $orderdetails->order_detail = json_encode(session()->get('cart')); 
		    $orderdetails->total_amount = session()->get('total'); 
		    $orderdetails->discount = session()->get('discount'); 
		    $orderdetails->discount_type = session()->get('discount_type'); 
		    $orderdetails->shipping_charge = session()->get('shipping_cost'); 
		    $orderdetails->grand_total = session()->get('total'); 
		    $orderdetails->payment_type = $payment_type; 
		    $orderdetails->save();

		    $ordId = array(
	    		'order_id'=>$orderdetails->id,
	    	);
	    	session()->put($ordId); 
	    	return redirect()->route('order.detail')->with('success','Your order place successfully!');
		    DB::commit();
	    }catch (\Exception $e) { 
		    DB::rollback();
            dd($e->getMessage());
    	}
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
	          	$cart = session()->get('cart'); 
      			if(!isset($cart[$id])) { 
					$cart[$id] = [
		                "id"     => $product->id,
						"name"   => $product->name,
						"option" => $option,
						"color"  => $color,
						"description" => $product->description,
						"quantity" => $qty,
						"product_qty" => $product->qty,
						"image"    => $product->image,
						"price"    => $product->price,
						"total_price" => ($product->price * $qty),
						"image" => fileView($product,'thumb','no','jpg','src'),
						"url"   => $product->productSlug(),
		            ];
			      	session()->put('cart', $cart);
			    }
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
	          	$id   = $request->get('id');
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
  	public function qtyAddMinus(Request $request){
  		if($request->ajax()){
	      	try {    
	          	$id   = $request->get('id');
	          	$qty   = $request->get('qty');
	          	$cart = session()->get('cart');
		      	if(isset($cart[$id])){
		      		$totalPrice = $cart[$id]['price']; 
			        $cart[$id]['quantity'] = $qty;
			        $cart[$id]['total_price'] = ($qty  * $totalPrice );
            		session()->put('cart', $cart); 
			    }
 
		      	return response()->json([
                    'success' => true, 
                    'message' => 'qty added', 
                ]); 
	        }catch (\Exception $e) {
		        return response()->json($e->getMessage());
    		}
    	}
  	}
  	public function applyCoupon(Request $request){
  		if($request->ajax()){
	      	try {    
	          	$code   = $request->get('code');
	          	$totalAmount   = $request->get('totalAmount');
	          	$cart = session()->get('cart'); 

	          	$coupon = Couponcode::getCoupon($code);
	          	$discountTp = '<i class="fa fa-inr"></i> 0.00';
	          	$discountType = '1';
	          	if($coupon){
	          		$discount = $coupon->discount;
	          		$type = $coupon->type;
	          		$total = '0';
	          		if($type == '1'){
	          			$total = ($totalAmount - $discount);
	          			$discountTp = '<i class="fa fa-inr"></i> '.$discount;
	          		}else{
	          			$discountAmt = (($totalAmount * $discount) / 100); 
	          			$total = ($totalAmount - $discountAmt);
	          			$discountTp = '<i class="fas fa-percent"></i>  '.$discount;
	          			$discountType = '2';
	          		}
	          		$json = [
	          			'status'=>2,
	          			'total'=>$total,
	          			'discount'=>$discount,
	          			'discountType'=>$discountType,
	          			'discountTp'=>$discountTp
	          		];
	          	}else{
	          		$json = [
	          			'status'=>3,
	          			'message'=>'coupon code not valid'
	          		];
	          	}
		      	return response()->json($json); 
	        }catch (\Exception $e) {
		        return response()->json($e->getMessage());
    		}
    	}
  	}
  	public function clearCart(Request $request){
  		if($request->ajax()){
	      	try {    
	          	Session::forget('cart');
		      	return response()->json([
                    'status' => 2, 
                    'message' => 'Cart removed successfully', 
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
  	public function viewCart(Request $request){
  		if($request->ajax()){
	      	try {   
	          	return view('user.checkout.cart-table');
	        }catch (\Exception $e) { 
		        return response()->json($e->getMessage());
    		}
    	}
  	}
    public function orderDetail(){
      	try {   
    		 DB::beginTransaction();
	    	$orderId = session()->get('order_id'); 
	    	Session::forget('cart');
	    	Session::forget('shipping_cost');
	    	Session::forget('final_total');
	    	Session::forget('discount_type');
	    	Session::forget('total');
	    	Session::forget('discount'); 
	    	$orderId  = '1';
	    	$order = OrderDetails::getOrder($orderId); 
	    	return view('user.checkout.order-detail',compact('order'));
		    DB::commit();
	    }catch (\Exception $e) { 
		    DB::rollback();
            dd($e->getMessage());
    	}
    }
}
