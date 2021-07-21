<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Validator;
use DB;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return view('admin.brand.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.brand.create');
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
            ]);
            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $brand                       = new Brand();
            $brand->name                 = $request->input('name');
            $brand->status               = $request->input('status'); 
            $brand->save();
            if ($request->hasFile('image')) {
                $image = $request->file('image');

               $name ='brand_'.$brand->id.'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/brand/');
                $image->move($destinationPath, $name);
                $brand->image= $name; 
                $brand->save();
            } 
            DB::commit();
            return redirect()->route('brand.index')->with('success',' Brand create successfully!');

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
            $brand = Brand::find(decrypt($id)); 
            DB::commit();
            return view('admin.brand.edit',compact('brand'));
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
            $brand = Brand::findOrFail(decrypt($id));
            $brand->name              = $request->input('name');
            $brand->status            = $request->input('status'); 
            $brand->save();
            if ($request->hasFile('image')) {
                $image = $request->file('image');

               $name ='brand_'.$brand->id.'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/brand/');
                $image->move($destinationPath, $name);
                $brand->image= $name; 
                $brand->save();
            } 
            DB::commit();
            return redirect()->route('brand.index')->with('success','Brand update Successfully.');
        } catch (DecryptException  $e) {
            return redirect()->route('brand.index')->with('error','Request URL does not match.');
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
            $brand = Brand::findOrFail($id); 
            $destinationPath = public_path('/uploads/brand/').$brand->image;

              if (file_exists($destinationPath)) { 
                @unlink($destinationPath); 
              } 
            $brand->status = 0; 
            $brand->save(); 
            DB::commit();
            return redirect()->route('brand.index')->with('success','Brand deActive successfully.');
        } catch (DecryptException  $e) { 
           return redirect()->route('brand.index')->with('error','Request URL does not match.');
        }
    }

     public function brandAjaxList(\App\Http\Requests\DataTableRequest $request){
        if($request->ajax()){
            try {  
                DB::beginTransaction();
                $recordSet = Brand::orderBy('name','ASC');
                if ($request->search['value'] != '') {
                    $recordSet->where('name','LIKE',$request->search['value']."%");
                }
                $recordsTotal = $recordSet->count();
                $brands = $recordSet->offset($request->start)->limit($request->length)->orderBy('id', 'desc')->get();
                $data = [];
                foreach ($brands as $key => $brand) {
                    $encryptBrandId = encrypt($brand->id);
                    $action = '';

                    $action .='<a href="'.route('brand.edit',$encryptBrandId).'" class="btn btn-sm btn-icon btn-info mr-2" title="Edit details"> <i class="la la-edit"></i></a>';

                    $action .= '<form action="'.route("brand.destroy", $brand->id).'" method="post" style="display:inline-block; vertical-align: middle; margin: 0;" id="'.$brand->id.'">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="hidden" name="_method" value="DELETE">';
                    $action .='<a href="javascript:;" data-toggle="modal" data-target="#confirmDelete" data-title="Delete" data-message="Are you sure you want to delete this service ?" class="btn btn-sm btn-icon btn-danger" title="Delete"><i class="la la-trash"></i></a>';
                    $action .='</form>';

                    $status = '<span class="badge badge-danger">DEACTIVE</span>';
                    if($brand->status == '1'){
                        $status = '<span class="badge badge-success">ACTIVE</span>';
                        $status = '<i class="fas fa-check text-success"></i>';
                    }

                    $data[] = [
                        str_replace(" ","",tableHeader(0))  => $key + 1,
                        str_replace(" ","",tableHeader(12))  => $brand->name,
                        str_replace(" ","",tableHeader(2))  => $brand->created_at->format('d-m-Y h:i A'),
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
}
