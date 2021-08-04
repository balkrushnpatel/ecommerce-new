<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\Product;
use Validator;
use DB;
use Session;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $products = Product::get(); 
        if($products->count()) {
            $response['data'] = $products->toArray(); 
        } else { 
            $response['status'] = false;
            $response['message'] = 'Product not found'; 
            
        }
        return response($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         try {  
          DB::beginTransaction();
          $validator = Validator::make($request->all(),[
              'name' => 'required',
              'cat_id' => 'required',
              'price' => 'required',
              'description' => 'required',
          ]);
          if ($validator->fails()) {
              return back()
                  ->withErrors($validator)
                  ->withInput();
          }
          $option = []; 
        if(!empty($request->input('title'))){
            foreach($request->input('title') as $key=>$title){
              $option[] = array(
                'title'=>$title,
                'choice'=>$request->input('choice')[$key],
                'option'=>$request->input('option')[$key],
              ); 
            }
        }  
            $product   = new Product();             
            $product->cat_id          = $request->input('cat_id');
            $product->subcat_id       = $request->input('subcat_id');
            $product->brand_id        = $request->input('brand_id');
            $product->name            = $request->input('name'); 
            $product->option          = json_encode($option);
            $product->color           = json_encode($request->input('input_color'));
            $product->description     = $request->input('description');
            $product->price           = $request->input('price');
            $product->qty             = $request->input('qty');
            $product->discount        = $request->input('discount');
            $product->discount_type    =$request->input('discount_type');
            $product->status          = '0'; 
            $product->unit            = $request->input('unit');
            $product->tags            = $request->input('tags');
            $product->purchase_price  = $request->input('purchase_price');
            $product->shipping_cost   = $request->input('shipping_cost');
            $product->tax             = $request->input('tax');
            $product->tax_type        =$request->input('tax_type');
            $product->specification   =$request->input('specification');
           $i = '0';
            if ($request->hasFile('image')) {
              $image = $request->file('image');
              $i = '1';
              foreach($image as $img){
                $name = $i.'.'.$img->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/product/'.$product->id);
                $img->move($destinationPath, $name);
                $i++;
               
              } 
            } 
            
           $product->image= $i;
             //dd($request->input());
           $product->save();

          DB::commit();
           $response['data'] = $product;
           $response['message'] = "Product Create successfully";
           return response($response);
      }catch (\Exception $e) {
          DB::rollback();
          dd($e->getMessage());
      } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
                  DB::beginTransaction();        
                  $option = [];
                  $color =[];
                  if(!empty($request->input('title'))){ 
                    foreach($request->input('title') as $key=>$title){
                      $option[] = array(
                        'title'=>$title,
                        'choice'=>$request->input('choice')[$key],
                        'option'=>$request->input('option')[$key],
                      );
                    } 
                  }
                  if(!empty($request->input('input_color'))){
                    foreach ($request->input('input_color') as $key => $clr) {
                      if(!empty($clr)){
                        $color[] = array( 
                          'color'=>$clr,
                        );
                      }
                    }
                  }
                  $product = Product::findOrFail($id); 
                  $product->cat_id          = $request->input('cat_id');
                  $product->subcat_id       = $request->input('subcat_id');
                  $product->brand_id        = $request->input('brand_id');
                  $product->name            = $request->input('name');
                  $product->description     = $request->input('description');
                  $product->price           = $request->input('price');
                  $product->qty             = $request->input('qty');
                  $product->discount        = $request->input('discount'); 
                  $product->discount_type    =$request->input('discount_type');
                  $product->unit            = $request->input('unit');
                  $product->tags            = $request->input('tags');
                  $product->purchase_price  = $request->input('purchase_price');
                  $product->shipping_cost   = $request->input('shipping_cost');
                  $product->tax             = $request->input('tax');
                  $product->tax_type        =$request->input('tax_type');
                  $product->specification   =$request->input('specification');
                  if(!empty($request->input('title'))){
                    $product->option          = json_encode($option);
                  }
                  if(!empty($request->input('input_color'))){
                    $product->color  = json_encode($request->input('input_color'));
                  }
                  $product->save(); 
                  if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $i = '1'; 
                    $i = '1';
                    foreach($image as $img){
                      $name = $i.'.'.$img->getClientOriginalExtension();
                      $destinationPath = public_path('/uploads/product/'.$product->id);
                       if(!File::exists($destinationPath)) {
                          File::makeDirectory($destinationPath, $mode = 0755, true, true);
                      }
                      $thumbnil= 'thumb_'.$name;

                      $imgThumb = ImageResize::make($img->path());
                      $imgThumb->resize(400, 400, function ($constraint) {
                          $constraint->aspectRatio();
                      })->save($destinationPath.'/'.$thumbnil); 
                      
                      $img->move($destinationPath, $name);

                      $i++;
                    } 
                    $product->image= $i; 
                    $product->save();
                  }
                  DB::commit();
                   $response['data'] = $product;
                   $response['message'] = "Product update successfully";
                  return response($response);
            }catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
          DB::beginTransaction();
          $product = Product::findOrFail($id);
          $destinationPath = public_path('/uploads/product/'.$product->id.'/').$product->image;

          if (file_exists($destinationPath)) { 
            @unlink($destinationPath); 
          } 
          $product->delete();
          DB::commit();
          return response(['message'=>'Product deleted Successfully']);
        }catch (\Exception $e) {
          DB::rollback();
          dd($e->getMessage());
        }
    }
}
