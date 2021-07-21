<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Validator;
use DB;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        return view('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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

            $category                       = new Category();
            $category->name                 = $request->input('name');
            $category->description          = $request->input('description');
            $category->status               = $request->input('status');
            $category->save();
             if ($request->hasFile('image')) {
                $image = $request->file('image');

                $name ='category_'.$category->id.'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/category/');
                $image->move($destinationPath, $name);
                $category->image= $name; 
                $category->save();
            } 
            DB::commit();
            return redirect()->route('categires.index')->with('success',' Category create successfully!');

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
            $category = Category::find(decrypt($id)); 
            DB::commit();
            return view('admin.category.edit',compact('category'));
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
            $category = Category::findOrFail(decrypt($id));
            $category->name              = $request->input('name');
            $category->description       = $request->input('description');
            $category->status            = $request->input('status'); 
            $category->save();
            if ($request->hasFile('image')) {
                $image = $request->file('image');

                $name ='category_'.$category->id.'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/category/');
                $image->move($destinationPath, $name);
                $category->image= $name; 
                $category->save();
            } 
            DB::commit();
            return redirect()->route('categires.index')->with('success','category update Successfully.');
        } catch (DecryptException  $e) {
            return redirect()->route('categires.index')->with('error','Request URL does not match.');
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
            $category = Category::findOrFail($id); 
            $destinationPath = public_path('/uploads/category/').$category->image;

              if (file_exists($destinationPath)) { 
                @unlink($destinationPath); 
              } 
            $category->status = 0; 
            $category->save(); 
            DB::commit();
            return redirect()->route('categires.index')->with('success','Category deActive successfully.');
        } catch (DecryptException  $e) { 
           return redirect()->route('categires.index')->with('error','Request URL does not match.');
        }
    }

    public function categoryAjaxList(\App\Http\Requests\DataTableRequest $request){
        if($request->ajax()){
            try {  
                DB::beginTransaction();
                $recordSet = Category::orderBy('name','ASC');
                if ($request->search['value'] != '') {
                    $recordSet->where('name','LIKE',$request->search['value']."%");
                }
                $recordsTotal = $recordSet->count();
                $categories = $recordSet->offset($request->start)->limit($request->length)->orderBy('id', 'desc')->get();
                $data = [];
                foreach ($categories as $key => $Category) {
                    $encryptCategoryId = encrypt($Category->id);
                    $action = '';

                    $action .='<a href="'.route('categires.edit',$encryptCategoryId).'" class="btn btn-sm btn-icon btn-info mr-2" title="Edit details"> <i class="la la-edit"></i></a>';

                    $action .= '<form action="'.route("categires.destroy", $Category->id).'" method="post" style="display:inline-block; vertical-align: middle; margin: 0;" id="'.$Category->id.'">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="hidden" name="_method" value="DELETE">';
                    $action .='<a href="javascript:;" data-toggle="modal" data-target="#confirmDelete" data-title="Delete" data-message="Are you sure you want to delete this service ?" class="btn btn-sm btn-icon btn-danger" title="Delete"><i class="la la-trash"></i></a>';
                    $action .='</form>';

                    $status = '<span class="badge badge-danger">DEACTIVE</span>';
                    if($Category->status == '1'){
                        $status = '<span class="badge badge-success">ACTIVE</span>';
                        $status = '<i class="fas fa-check text-success"></i>';
                    }

                    $data[] = [
                        str_replace(" ","",tableHeader(0)) => $key + 1,
                        str_replace(" ","",tableHeader(7))  => $Category->name,
                        str_replace(" ","",tableHeader(5))  => $Category->description,
                        str_replace(" ","",tableHeader(2))  => $Category->created_at->format('d-m-Y h:i A'),
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
