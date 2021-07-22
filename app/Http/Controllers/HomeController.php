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

class HomeController extends Controller{ 
  public function __construct(){         
  }
  public function index()    { 
  	$sliders=Slider::all();
    $featuredProduct=Product::feactureProduct();
    $todayDeal=Product::todayDeal();
    
    $newArrival=Product::newArrival();
    return view('userhome',compact('sliders','featuredProduct','newArrival','todayDeal'));
  }  
  public function aboutUs(){
    return view('user.about');
  }
  public function privacyPolicy(){
    return view('user.privacy-policy');
  }
  public function termAndCondition(){
    return view('user.term-condition');
  }
  public function category(){ 
    $products=Product::where('status',1)->get();
    return view('user.category',compact('products'));
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

    $orderdetails->order_detail =json_encode(session()->get('cart')); 

    $orderdetails->grandtotal = $request->input('finaltotal');
    $orderdetails->shipping_type =$request->input('shipping_type');
    $orderdetails->save();
    return redirect()->route('userhome')->with('success',' Order Place successfully!');
  }
  function headersearch(Request $request){
    if($request->ajax()){
      try {  
        DB::beginTransaction();
        $category = $request->catId;
         $product = Product::select("name","cat_id")
          ->where("name","LIKE","%{$request->term}%");
        if(!empty($category)){
          $product->where("cat_id",$category);
        }
        $product = $product->get();
        foreach ($product as $key => $pro) {
          $data[] = $pro['name'];
        }
        DB::commit();
        return response()->json($data);
      }catch (\Exception $e) {
        DB::rollback(); 
        return response()->json($e->getMessage());
      } 
    }else{
      return abort(404);
    }
  }
}
