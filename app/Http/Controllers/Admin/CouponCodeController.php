<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Couponcode;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use Validator;
use DB;
class CouponCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.couponcode.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.couponcode.create');
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
                'code'        =>'required',
                'description' => 'required',
            ]);
            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $code                           = new Couponcode();
            $code->code                     = $request->input('code');
            $code->description              = $request->input('description');
            $code->type                     = $request->input('type');
            $code->discount                 = $request->input('discount');
            $code->discount_on              =$request->input('discount_on');
            $code->cat_id              = ($request->input('cat_id') ? implode(",",$request->input('cat_id')) : null);

            $code->valid_date               = date('Y-m-d', strtotime($request->input('valid_date'))); 
            $code->status                   = $request->input('status'); 
            $code->save();
            DB::commit();
            return redirect()->route('couponcode.index')->with('success',' Couponcode create successfully!');

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
            $code = Couponcode::find(decrypt($id)); 
            DB::commit();
            return view('admin.couponcode.edit',compact('code'));
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
            $code = Couponcode::findOrFail(decrypt($id));
            $code->code                     = $request->input('code');
            $code->description              = $request->input('description');
            $code->type                     = $request->input('type');
            $code->discount                 = $request->input('discount');
            $code->valid_date               = date('Y-m-d', strtotime($request->input('valid_date'))); 
            $code->discount_on              =$request->input('discount_on');
            $code->cat_id                   =$request->input('cat_id');
            $code->status                   = $request->input('status'); 
            $code->save();
            DB::commit();
            return redirect()->route('couponcode.index')->with('success','couponcode update Successfully.');
        } catch (DecryptException  $e) {
            return redirect()->route('couponcode.index')->with('error','Request URL does not match.');
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
            $code = Couponcode::findOrFail($id); 
            $code->status = 0; 
            $code->save(); 
            DB::commit();
            return redirect()->route('couponcode.index')->with('success','couponcode deActive successfully.');
        } catch (DecryptException  $e) { 
           return redirect()->route('couponcode.index')->with('error','Request URL does not match.');
        }
    }

    public function couponcodeAjaxList(\App\Http\Requests\DataTableRequest $request){
        if($request->ajax()){
            try {  
                DB::beginTransaction();
                $recordSet = Couponcode::orderBy('id','ASC');
                $recordsTotal = $recordSet->count();
                $codes = $recordSet->offset($request->start)->limit($request->length)->orderBy('id', 'desc')->get();
                $data = [];
                foreach ($codes as $key => $code) {
                    $encryptCodeId = encrypt($code->id);
                    $action = '';

                    $action .='<a href="'.route('couponcode.edit',$encryptCodeId).'" class="btn btn-sm btn-icon btn-info mr-2" title="Edit details"> <i class="la la-edit"></i></a>';

                    $action .= '<form action="'.route("couponcode.destroy", $code->id).'" method="post" style="display:inline-block; vertical-align: middle; margin: 0;" id="'.$code->id.'">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="hidden" name="_method" value="DELETE">';
                    $action .='<a href="javascript:;" data-toggle="modal" data-target="#confirmDelete" data-title="Delete" data-message="Are you sure you want to delete this service ?" class="btn btn-sm btn-icon btn-danger" title="Delete"><i class="la la-trash"></i></a>';
                    $action .='</form>';

                    $status = '<span class="badge badge-danger">DEACTIVE</span>';
                    if($code->status == '1'){
                        $status = '<span class="badge badge-success">ACTIVE</span>';
                        $status = '<i class="fas fa-check text-success"></i>';
                    }
                     $type='amount';
                     if( $code->type=='2')
                     {
                        $type='percentage';
                     }

                     $discountOn='All Product';
                     if( $code->discount_on=='2')
                     {
                        $discountOn='Category';
                     }
                     else if( $code->discount_on=='3')
                     {
                        $discountOn='SubCategory';
                     }
                     else if($code->discount_on=='4')
                     {
                        $discountOn='Product';
                     }
                    $data[] = [
                        str_replace(" ","",tableHeader(0))  => $key + 1,
                        str_replace(" ","",tableHeader(14)) => $code->code,
                        str_replace(" ","",tableHeader(5))  => $code->description,
                        str_replace(" ","",tableHeader(15)) => $type,
                        str_replace(" ","",tableHeader(13)) => $code->discount,
                        str_replace(" ","",tableHeader(19)) => $code->valid_date,
                         str_replace(" ","",tableHeader(20)) => $discountOn,
                        str_replace(" ","",tableHeader(2))  => $code->created_at->format('d-m-Y h:i A'),
                        str_replace(" ","",tableHeader(3))  => $status,
                        str_replace(" ","",tableHeader(4))  => $action,
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

     public function getCategory(Request $request){
        if($request->ajax()){
            try {  
                DB::beginTransaction();
                $discountOn = $request->discount_on;
                if($discountOn == 2){
                    $categories = Category::get()->pluck('name','id'); 
                }else if($discountOn == 3){
                    $categories = SubCategory::get()->pluck('name','id'); 
                }else if($discountOn == 4){
                    $categories = Product::get()->pluck('name','id'); 
                }else{
                    $categories = [];
                }
                
                if($categories){
                    $response['success'] = true;
                    $response['data'] = $categories;
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
