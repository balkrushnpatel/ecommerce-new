<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Validator;
use DB;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
       
    }
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
                'description' => 'required',
            ]);
            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $option = [];
            $color =[];
            if(!empty($request->input('input_title')))
            {

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
            $product   = new Product();
            $size = NULL;
            if(!empty($request->input('size'))){
              $size = json_encode($product->size); 
            }
            
            $product->cat_id                   = $request->input('cat_id');
            $product->subcat_id                = $request->input('subcat_id');
            $product->brand_id                 = $request->input('brand_id');
            $product->name                     = $request->input('name');
            $product->size                     = $size;
            $product->title_choice             = json_encode($option);
            $product->input_color            = json_encode($color);
            $product->description              = $request->input('description');
            $product->price                    = $request->input('price');
            $product->qty                      = $request->input('qty');
            $product->discount                 = $request->input('discount');
            $product->status                   = $request->input('status'); 
          // dd($product);
            $product->save();
              if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $name = time().'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/uploads/product/'.$product->id);
                    $image->move($destinationPath, $name); 
                    $product->image= $name; 
                    $product->save();
            } 
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
    public function update(Request $request, $id)
    {
         try {
            DB::beginTransaction();
            
            $option = [];
            $color =[];
            if(!empty($request->input('input_title')))
            {

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
            $product->cat_id                   = $request->input('cat_id');
            $product->subcat_id                = $request->input('subcat_id');
            $product->brand_id                 = $request->input('brand_id');
            $product->name                     = $request->input('name');
            $product->size                    = $request->input('size');
            $product->description              = $request->input('description');
            $product->price                    = $request->input('price');
            $product->qty                      = $request->input('qty');
            $product->discount                 = $request->input('discount');
            $product->status                   = $request->input('status'); 
            $product->title_choice             = json_encode($option);
            $product->input_color            = json_encode($color);
            $product->save(); 
            DB::commit();
              if ($request->hasFile('image')) {
                if(!empty($request->file('image'))){
                    $image = $request->file('image');
                    $name = time().'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/uploads/product/'.$product->id);
                    $image->move($destinationPath, $name); 
                    $product->image = $name; 
                    $product->save();
                }
            } 
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

                    $status = '<span class="badge badge-danger">DEACTIVE</span>';
                    if($product->status == '1'){
                        $status = '<span class="badge badge-success">ACTIVE</span>';
                        $status = '<i class="fas fa-check text-success"></i>';
                    }
                    $checked = '';
                    if($product->is_featured == '1'){
                      $checked = 'checked';
                    }
                    $featured= '<span class="switch switch-outline switch-icon switch-success">
                                   <label>
                                   <input type="checkbox" '.$checked.' name="select" value="'.$product->id.'" class="is_fectured"/>
                                   <span></span>
                                  </label>
                                </span>';
                    $data[] = [
                        str_replace(" ","",tableHeader(0)) =>  $key + 1,
                        str_replace(" ","",tableHeader(7)) => $product->proCategory->name,
                        str_replace(" ","",tableHeader(12))=> $product->proBrand->name,
                        str_replace(" ","",tableHeader(1)) => $product->name,
                         str_replace(" ","",tableHeader(23)) => $product->size,
                        str_replace(" ","",tableHeader(5)) => $product->description,
                        str_replace(" ","",tableHeader(10))=> $product->qty,
                        str_replace(" ","",tableHeader(6)) => $product->price,
                        str_replace(" ","",tableHeader(13))=> $product->discount,
                        str_replace(" ","",tableHeader(22))=> $featured,
                        str_replace(" ","",tableHeader(2)) => $product->created_at->format('d-m-Y h:i A'),
                        str_replace(" ","",tableHeader(3)) => $status,
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
                return response()->json([ 
                  'success'=>true
                ]);
            }catch (\Exception $e) {
                DB::rollback(); 
                return response()->json($e->getMessage());
            } 
        }else{
            return abort(404);
        }
    }
}
