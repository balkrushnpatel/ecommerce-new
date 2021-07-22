<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Productstock;
use App\Models\Product;
use App\Models\SubCategory;
use Validator;
use DB;
class ProductStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return view('admin.productstock.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stoct = 'add';
       return view('admin.productstock.create',compact('stoct'));
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
               
                'note' => 'required',
            ]);
            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }
           
            $stock                          = new Productstock();
            $stock->cat_id                  = $request->input('cat_id');
            $stock->subcat_id               = $request->input('subcat_id');
            $stock->product_id              = $request->input('product_id');
            if($request->input('stoct') == 'add'){
                $stock->qty                 = $request->input('qty'); 
            }else{
                $stock->qty                 = '-'.$request->input('qty');
            }
            
            $stock->price                   = $request->input('price');
            $totalAmount                    =($stock->qty)*($stock->price);
            $stock->total                   = $totalAmount;
            $stock->note                    = $request->input('note');
            $stock->status                  = $request->input('status');
            $stock->save();

            $product=Product::findOrFail($request->input('product_id'));
            $product->qty = ($product->qty + $stock->qty);
            $product->save();

            DB::commit();
            return redirect()->route('productstock.index')->with('success',' Productstock create successfully!');

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
        //
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
      $stoct = Productstock::findOrFail($id)->delete();
      DB::commit();
      return redirect()->route('productstock.index')->with('success','Productstock  Destroy successfully.');
    }catch (\Exception $e) {
      DB::rollback();
      dd($e->getMessage());
    } 
    }

    public function destroystock()
    {
        $stoct = 'destroy';
       return view('admin.productstock.create',compact('stoct'));
    }

    public function productstockAjaxList(\App\Http\Requests\DataTableRequest $request){
        if($request->ajax()){
            try {  
                DB::beginTransaction();
                $recordSet = Productstock::orderBy('id','ASC');
                $recordsTotal = $recordSet->count();
                $stocks = $recordSet->offset($request->start)->limit($request->length)->orderBy('id', 'desc')->get();
                $data = [];
                foreach ($stocks as $key => $stock) {
                    $encryptproductId = encrypt($stock->id);
                    $action = '';

                    $action .= '<form action="'.route("productstock.destroy", $stock->id).'" method="post" style="display:inline-block; vertical-align: middle; margin: 0;" id="'.$stock->id.'">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="hidden" name="_method" value="DELETE">';
                    $action .='<a href="javascript:;" data-toggle="modal" data-target="#confirmDelete" data-title="Delete" data-message="Are you sure you want to delete this service ?" class="btn btn-sm btn-icon btn-danger" title="Delete"><i class="la la-trash"></i></a>';
                    $action .='</form>';

                    $status = '<span class="badge badge-danger">DEACTIVE</span>';
                    if($stock->status == '1'){
                        $status = '<span class="badge badge-success">ACTIVE</span>';
                        $status = '<i class="fas fa-check text-success"></i>';
                    }

                    $data[] = [
                        str_replace(" ","",tableHeader(0)) =>  $key + 1,
                        str_replace(" ","",tableHeader(7)) => $stock->stockCat->name,
                        str_replace(" ","",tableHeader(11)) => $stock->stockSubCat->name,
                        str_replace(" ","",tableHeader(17)) => $stock->stockPro->name,
                       
                        str_replace(" ","",tableHeader(10))=> $stock->qty,
                        str_replace(" ","",tableHeader(6)) => $stock->price,
                        str_replace(" ","",tableHeader(18))=> $stock->total,
                        str_replace(" ","",tableHeader(16)) => $stock->note,
                        str_replace(" ","",tableHeader(2)) => $stock->created_at->format('d-m-Y h:i A'),
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
    public function getSubcategory(Request $request){
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
    public function getProduct(Request $request){
        if($request->ajax()){
            try {  
                DB::beginTransaction();
                $catId = $request->cat_id;
                $scatId = $request->subcat_id;
                $products = Product::where('subcat_id',$scatId)->where('cat_id',$catId)->get()->pluck('name','id'); 
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
    public function getProductPrice(Request $request){
        if($request->ajax()){
            try {  
                DB::beginTransaction();
                $productId = $request->productId; 
                $products = Product::where('id',$productId)->first(); 
                if($products){
                    $response['success'] = true;
                    $response['price'] = $products->price;
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
