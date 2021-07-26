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
