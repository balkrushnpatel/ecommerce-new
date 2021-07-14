<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Product;
use App\Models\OrderDetails;
use session;
use Validator;
use DB;
use Mail;
use App\Mail\ContactUsMail;

class UserHomeController extends Controller
{
    public function __construct(){         
    }

    public function index()
    { 
    	$sliders=Slider::all();
      $featuredProduct=Product::where('is_featured',1)->get();
      return view('userhome',compact('sliders','featuredProduct'));
    }
    public function productDetail(Request $request,$id){
          
            $product = Product::find($id);  
            return view('user.product-details',compact('product'));
    }

    public function addtoCart(Request $request,$id)
    {   
      
      $product = Product::find($id);
      $cart = session()->get('cart'); 
      if(!$cart) {
          $cart = [
              $id => [
                  "id"   =>$product->id,
                  "name" => $product->name,
                  "size" => $request->input('size'),
                  "description" => $product->description,
                  "quantity" => !empty($request->input('quantity')) ? $request->input('quantity') : 1,
                  "image"=>$product->image,
                  "price" => $product->price,
              ]
          ]; 
          session()->put('cart', $cart);
        
      }    
        // if cart not empty then check if this product exist then increment quantity
      if(isset($cart[$id])) {
          $cart[$id]['quantity']++;
          session()->put('cart', $cart);
         
      } 
      $cart[$id] = [
          "id"   =>$product->id,
          "name" => $product->name,
          "size" => $request->input('size'),
          "description" => $product->description,
          "quantity" => !empty($request->input('quantity')) ? $request->input('quantity') : 1,
          "image"=>$product->image,
          "price" => $product->price,
      ];
      session()->put('cart', $cart); 
      return view('user.checkout.cart',compact('product'));        
    }

    public function removetoCart($id){ 
      $product = Product::find($id);
     if($id)
     {
       $cart = session()->get('cart');
       if(isset($cart[$id]))
       {
         unset($cart[$id]);
        session()->put('cart', $cart);
       }
         return view('user.viewCart',compact('product'));
     }   
    }

    public function checkout(Request $request)
    {   
      $quantity = $request->input('quantity');
      $grandtotal = $request->input('grandtotal');
      $sessionCart = session()->get('cart'); 
      foreach($sessionCart as $key=>$item){
          if(isset($quantity[$item['id']]) && !empty($quantity[$item['id']])){

              $item['quantity'] = $quantity[$item['id']]['quantity'];
          }
          $cart[$item['id']] = $item;
          session()->put('cart', $cart);
      }
       session()->put('grandtotal', $grandtotal);
    

       return view('user.checkout');
    } 

     public function productListing()
    {   

         $products=Product::where('status',1)->get();
        return view('user.shop',compact('products'));
    } 

    public function aboutUs(){
      return view('user.about');
    }

    public function category(){ 
            $products=Product::where('status',1)->get();
        return view('user.category',compact('products'));
    }

    public function categoryFilter($id){
             //category filter
             $products = Product::where('cat_id',$id)->where('status',1)->get();
            
       return view('user.productfilter',compact('products'));
    } 

    public function contactUs(){
      return view('user.contact');
    }
    public function contactUsSend(Request $request){
      try {  
        DB::beginTransaction();
        $validator = Validator::make($request->all(),[ 
            'name' => 'required', 
            'email_id' => 'required', 
            'subject' => 'required', 
            'message' => 'required', 
        ]);
        if ($validator->fails()) {
            return back()
                    ->withErrors($validator)
                    ->withInput();
        }
        $data = array(
          'name'=>$request->input('name'),
          'email_id'=>$request->input('email_id'),
          'subject'=>$request->input('subject'),
          'message'=>$request->input('message'),
        );
        Mail::to(env('RECEIVE_EMAIL'))->send(new ContactUsMail($data));
        DB::commit();
        return redirect()->route('contact-us')->with('success','Inquirey send successfully!');
      }catch (\Exception $e) {
          DB::rollback();
          dd($e->getMessage());
      }
    }   
    public function orderPlace(Request $request){
            $orderdetails =new OrderDetails();           
            //shipping information
            $orderdetails->user_id = auth()->user()->id;
            $orderdetails->status  = 'pending'; 
            $orderdetails->fname =$request->input('fname');
            $orderdetails->lname =$request->input('lname');
            $orderdetails->email =$request->input('email');
            $orderdetails->address =$request->input('address');
            $orderdetails->city =$request->input('city');
            $orderdetails->state =$request->input('state');
            $orderdetails->zip =$request->input('zip');
            $orderdetails->country=$request->input('country');
            $orderdetails->mobile_no =$request->input('mobile_no');

             //your order
              $orderdetails->order_detail =json_encode(session()->get('cart')); 

            $orderdetails->grandtotal = $request->input('finaltotal');

            //payment
           $orderdetails->shipping_type =$request->input('shipping_type');
           //dd($orderdetails);
           $orderdetails->save();

           return redirect()->route('userhome')->with('success',' Order Place successfully!');

    }

}
