<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Brand;
use Validator;
use ImageResize;
use DB;
use File;
class ProductController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
       return view('admin.product.index');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
       return view('admin.product.create');
  }
 
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
          if(!empty($request->input('input_title'))){
            foreach($request->input('input_title') as $key=>$title){
              $option[] = array(
                'title'=>$title,
                'choice'=>$request->input('title_choice')[$key],
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
          $product->save();
          DB::commit();
          return redirect()->route('product.index')->with('success',' Product create successfully!');
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
      //
  }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  public function edit($id)
  {
      try {
        DB::beginTransaction();
        $product = Product::find(decrypt($id)); 
        DB::commit();
        return view('admin.product.edit',compact('product'));
      }catch (\Exception $e) {
        DB::rollback();
        dd($e->getMessage());
      }
  }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */ 
  public function update(Request $request, $id){
    try {
      DB::beginTransaction();        
      $option = [];
      $color =[];
      if(!empty($request->input('input_title'))){ 
        foreach($request->input('input_title') as $key=>$title){
          $option[] = array(
            'title'=>$title,
            'choice'=>$request->input('title_choice')[$key],
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
      $product = Product::findOrFail(decrypt($id));  
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
      if(!empty($request->input('input_title'))){
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
      return redirect()->route('product.index')->with('success','Product update Successfully.');
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
  public function createThumbnail($path, $width, $height){
      $img = Image::make($path)->resize($width, $height, function ($constraint) {
          $constraint->aspectRatio();
      });
      $img->save($path);
  }
  public function destroy($id)
  {
    try {
      DB::beginTransaction();
      $product = Product::findOrFail($id);
      $destinationPath = public_path('/uploads/product/'.$product->id.'/').$product->image;

      if (file_exists($destinationPath)) { 
        @unlink($destinationPath); 
      } 
      $product->status = 0; 
      $product->save(); 
      DB::commit();
      return redirect()->route('product.index')->with('success','Product  De Active successfully.');
    }catch (\Exception $e) {
      DB::rollback();
      dd($e->getMessage());
    } 
  } 
  public function productAjaxList(\App\Http\Requests\DataTableRequest $request){
    if($request->ajax()){
      try {  
        DB::beginTransaction();
        $recordSet = Product::orderBy('name','ASC');
        if ($request->search['value'] != '') {
            $recordSet->where('name','LIKE',$request->search['value']."%");
        }
        $recordsTotal = $recordSet->count();
        $products = $recordSet->offset($request->start)->limit($request->length)->orderBy('id', 'desc')->get();
        $data = [];
        foreach ($products as $key => $product) {
            $encryptproductId = encrypt($product->id);
            $action = '';

            $action .='<a href="'.route('product.edit',$encryptproductId).'" class="btn btn-sm btn-icon btn-info mr-2" title="Edit details"> <i class="la la-edit"></i></a>';

            $action .= '<form action="'.route("product.destroy", $product->id).'" method="post" style="display:inline-block; vertical-align: middle; margin: 0;" id="'.$product->id.'">
                <input type="hidden" name="_token" value="'.csrf_token().'">
                <input type="hidden" name="_method" value="DELETE">';
            $action .='<a href="javascript:;" data-toggle="modal" data-target="#confirmDelete" data-title="Delete" data-message="Are you sure you want to delete this service ?" class="btn btn-sm btn-icon btn-danger" title="Delete"><i class="la la-trash"></i></a>';
            $action .='</form>';

            $schecked = '';
            if($product->status == '1'){
                $schecked = 'checked';
            } 
            $status= '<span class="switch switch-outline switch-icon switch-primary">
                 <label>
                 <input type="checkbox" '.$schecked.' value="'.$product->id.'" class="is_status"/>
                 <span></span>
                </label>
              </span>';
            $checked = ''; 
            if($product->is_featured == '1'){
              $checked = 'checked';
            }
            $featured= '<span class="switch switch-outline switch-icon switch-success">
                 <label>
                 <input type="checkbox" '.$checked.' value="'.$product->id.'" class="is_fectured"/>
                 <span></span>
                </label>
              </span>'; 

            $tDchecked = '';
            if($product->today_deal == '1'){
              $tDchecked = 'checked';
            }
            $todayDeal= '<span class="switch switch-outline switch-icon switch-info">
                 <label>
                 <input type="checkbox" '.$tDchecked.' value="'.$product->id.'" class="today_deal"/>
                 <span></span>
                </label>
              </span>'; 

            $data[] = [
                str_replace(" ","",tableHeader(0)) =>  $key + 1,
                str_replace(" ","",tableHeader(24)) => $product->createdBy->name, 
                str_replace(" ","",tableHeader(1)) => $product->name, 
                str_replace(" ","",tableHeader(10))=> $product->qty, 
                str_replace(" ","",tableHeader(26))=> $todayDeal, 
                str_replace(" ","",tableHeader(22))=> $featured, 
                str_replace(" ","",tableHeader(25)) => $status,
                str_replace(" ","",tableHeader(4)) =>  $action,
            ];
        }
        DB::commit();
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsTotal,
            'data' => $data,
        ]);
      }catch (\Exception $e) {
        DB::rollback(); 
        return response()->json($e->getMessage());
      }
    }else{
      return abort(404);
    }
  }
  function setFectured(Request $request){
    if($request->ajax()){
      try {  
        DB::beginTransaction();
        $id = $request->id;
        $isFecture = $request->isFecture;

        $product = Product::findOrFail($id);  
        $product->is_featured = $isFecture;
        $product->save();
        DB::commit();
        $featured = 'un featured';
        $status = 3;
        if($public == 1){
          $status = 2;
          $featured = 'featured';
        }
        return response()->json([ 
          'status'=>$status ,
          'message'=>'Product '.$featured,
        ]);
      }catch (\Exception $e) {
        DB::rollback(); 
        return response()->json($e->getMessage());
      } 
    }else{
      return abort(404);
    }
  }
  function setPublic(Request $request){
    if($request->ajax()){
      try {  
        DB::beginTransaction();
        $id = $request->id;
        $isPublic = $request->isPublic;

        $product = Product::findOrFail($id);  
        $product->status = $isPublic;
        $product->save();
        DB::commit();
        $public = 'un public';
        $status = 3;
        if($isPublic == 1){
          $public = 'public';
          $status = 2;
        }
        return response()->json([ 
          'status'=>$status,
          'message'=>'Product '.$public.' successfully',
        ]);
      }catch (\Exception $e) {
        DB::rollback(); 
        return response()->json($e->getMessage());
      } 
    }else{
      return abort(404);
    }
  }
  function setTodayDeal(Request $request){
    if($request->ajax()){
      try {  
        DB::beginTransaction();
        $id = $request->id;
        $isTodayDeal = $request->today_deal; 
        $product = Product::findOrFail($id);  
        $product->today_deal = $isTodayDeal;
        $product->save();
        DB::commit();

        $todayDeal = 'Product remove from today deal';
        $status = 3;
        if($isTodayDeal == 1){
          $status = 2;
          $todayDeal = 'Product add in today deal';
        }
        return response()->json([ 
          'status'=>$status,
          'message'=>$todayDeal,
        ]);
      }catch (\Exception $e) {
        DB::rollback(); 
        return response()->json($e->getMessage());
      } 
    }else{
      return abort(404);
    }
  }
  public function getSubcategories(Request $request){
    if($request->ajax()){
      try {   
        DB::beginTransaction();
        $catId = $request->cat_id;
        $subcategories = SubCategory::where('cat_id',$catId)->get()->pluck('name','id'); 
        
        if($subcategories){
          $response['success'] = true;
          $response['data'] = $subcategories;
        }else{
          $response['success'] = false;
        }
        return response()->json($response);
      }catch (\Exception $e) {
        DB::rollback(); 
        return response()->json($e->getMessage());
      } 
    }else{
      return abort(404);
    }
  }
  public function getBrand(Request $request){
    if($request->ajax()){
      try {  
        DB::beginTransaction();
        $catId = $request->cat_id;
        $scatId = $request->subcat_id;
        
        $brands = SubCategory::where('id',$scatId)->first()->brand;
        
        $brand=json_decode($brands);
        $products = Brand::whereIn('id',$brand)->get()->pluck('name','id');

        if($products){
          $response['success'] = true;
          $response['data'] = $products;
        }else{
          $response['success'] = false;
        }
        return response()->json($response);
      }catch (\Exception $e) {
        DB::rollback(); 
        return response()->json($e->getMessage());
      } 
    }else{
        return abort(404);
    }
  }
}
