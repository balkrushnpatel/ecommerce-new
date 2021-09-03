<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Product;
use App\Models\OrderDetails;
use App\Models\Faq;
use App\Models\Brand;
use App\Models\Blog;
use App\Models\HomeCategory;
use App\Models\Banner;
use session;
use Validator;
use DB;
use Mail; 
use App\Mail\ContactUsMail;

class HomeController extends Controller{ 
  public function __construct(){         
  }
  public function index()    { 
  	$sliders=Slider::get();
    $featuredProduct=Product::feactureProduct();
    $todayDeal=Product::todayDeal();
    $mostPopular=Product::mostPopular();
    $banners=Banner::where('is_home','1')->limit(3)->get();
    $categories =Category::where('status','1')->limit(6)
    ->inRandomOrder()->get();
    $brands = Brand::where('status','1')->limit(12) ->inRandomOrder()->get();
    $blogs = Blog::where('status','1')->limit(3) ->inRandomOrder()->get();
    $views=Product::orderBy('last_viewed','DESC')->limit(8)->get();
    $homeCat=HomeCategory::get()->pluck('cat_id');
    $home_category = [];
    $products = [];
    if(count($homeCat)){
        $categoriess = Category::where('status', 1)->whereIn('id',$homeCat)->get();
        $products = [];
        foreach ($categoriess as $key => $item) {
          $products = Product::where('cat_id', $item->id)->where('status', 1)->get(); 

          $image =  asset('uploads/noimage.jpg');
          $categoryImage = public_path('uploads/category/') . $item->image;
          if(file_exists($categoryImage)){
            $image = asset('uploads/category/'.$item->image);
          }
          $banner = HomeCategory::where('cat_id',$item->id)->first();
          $home_category[] = array(
            'id'=>$item->id,
            'name'=>$item->name,
            'slug'=>$item->slug,
            'image'=>$image,
            'banner'=>$banner->banner,
            'product'=>$products,
          );
        }
     }
     //dd($home_category);
    $newArrival=Product::newArrival();
    return view('userhome',compact('sliders','featuredProduct','newArrival','todayDeal','categories','brands','blogs','products','home_category','views','mostPopular','banners'));
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
    $faqs=Faq::get();
    return view('user.contact',compact('faqs'));
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
