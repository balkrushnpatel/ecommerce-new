<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use Validator;
use DB;
class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return view('admin.subcategory.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.subcategory.create');
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

            $subcategory                       = new SubCategory();
            $subcategory->cat_id               = $request->input('cat_id');
            $subcategory->name                 = $request->input('name');
            $subcategory->description          = $request->input('description');
            $subcategory->status               = $request->input('status'); 
            $subcategory->save();
            DB::commit();
            return redirect()->route('subcategory.index')->with('success',' SubCategory create successfully!');

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
            $subcategory = SubCategory::find(decrypt($id)); 
            DB::commit();
            return view('admin.subcategory.edit',compact('subcategory'));
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
            $subcategory = SubCategory::findOrFail(decrypt($id));
            $subcategory->cat_id            = $request->input('cat_id');
            $subcategory->name              = $request->input('name');
            $subcategory->description       = $request->input('description');
            $subcategory->status            = $request->input('status'); 
            $subcategory->save();
            DB::commit();
            return redirect()->route('subcategory.index')->with('success','subcategory update Successfully.');
        } catch (DecryptException  $e) {
            return redirect()->route('subcategory.index')->with('error','Request URL does not match.');
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
            $subcategory = SubCategory::findOrFail($id); 
            $subcategory->status = 0; 
            $subcategory->save(); 
            DB::commit();
            return redirect()->route('subcategory.index')->with('success','SubCategory deActive successfully.');
        } catch (DecryptException  $e) { 
           return redirect()->route('subcategory.index')->with('error','Request URL does not match.');
        }
    }

     public function subcategoryAjaxList(\App\Http\Requests\DataTableRequest $request){
        if($request->ajax()){
            try {  
                DB::beginTransaction();
                $recordSet = SubCategory::orderBy('name','ASC');
                if ($request->search['value'] != '') {
                    $recordSet->where('name','LIKE',$request->search['value']."%");
                }
                $recordsTotal = $recordSet->count();
                $subcategories = $recordSet->offset($request->start)->limit($request->length)->orderBy('id', 'desc')->get();
                $data = [];
                foreach ($subcategories as $key => $subcategory) {
                    $encryptsubCategoryId = encrypt($subcategory->id);
                    $action = '';

                    $action .='<a href="'.route('subcategory.edit',$encryptsubCategoryId).'" class="btn btn-sm btn-icon btn-info mr-2" title="Edit details"> <i class="la la-edit"></i></a>';

                    $action .= '<form action="'.route("subcategory.destroy", $subcategory->id).'" method="post" style="display:inline-block; vertical-align: middle; margin: 0;" id="'.$subcategory->id.'">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="hidden" name="_method" value="DELETE">';
                    $action .='<a href="javascript:;" data-toggle="modal" data-target="#confirmDelete" data-title="Delete" data-message="Are you sure you want to delete this service ?" class="btn btn-sm btn-icon btn-danger" title="Delete"><i class="la la-trash"></i></a>';
                    $action .='</form>';

                    $status = '<span class="badge badge-danger">DEACTIVE</span>';
                    if($subcategory->status == '1'){
                        $status = '<span class="badge badge-success">ACTIVE</span>';
                        $status = '<i class="fas fa-check text-success"></i>';
                    }

                    $data[] = [
                        str_replace(" ","",tableHeader(0)) =>  $key + 1,
                        str_replace(" ","",tableHeader(7)) => $subcategory->category->name,
                        str_replace(" ","",tableHeader(11)) => $subcategory->name,
                        str_replace(" ","",tableHeader(5))  => $subcategory->description,
                        str_replace(" ","",tableHeader(2))  => $subcategory->created_at->format('d-m-Y h:i A'),
                        str_replace(" ","",tableHeader(3))  => $status,
                        str_replace(" ","",tableHeader(4))  =>  $action,
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
