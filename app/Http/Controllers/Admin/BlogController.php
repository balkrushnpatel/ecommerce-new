<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Validator;
use DB;
class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.blog.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blog.create');
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
                'title' => 'required',
                'description' => 'required',
                'image'=>'required',
            ]);
            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $blog                       = new Blog();
            $blog->title                = $request->input('title');
            $blog->blog_cat_id          = $request->input('blog_cat_id');
            $blog->summary              = $request->input('summary');
            $blog->description          = $request->input('description');
            $blog->author               = $request->input('author');
            $blog->status               = $request->input('status'); 
            $blog->save();
            if ($request->hasFile('image')) {
                    $image = $request->file('image');
                   
                      $name = time().'.'.$image->getClientOriginalExtension();
                      $destinationPath = public_path('/uploads/blog/'.$blog->id);
                      $image->move($destinationPath, $name); 
                       $data[]=$name;
                       $blog->image= $name; 
                       $blog->save();
            } 
            DB::commit();
            return redirect()->route('blog.index')->with('success',' Blog create successfully!');

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
            $blog = Blog::find(decrypt($id)); 
            DB::commit();
            return view('admin.blog.edit',compact('blog'));
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
            $blog = Blog::findOrFail(decrypt($id));
            $blog->title                = $request->input('title');
            $blog->blog_cat_id          = $request->input('blog_cat_id');
            $blog->summary              = $request->input('summary');
            $blog->description          = $request->input('description');
            $blog->author               = $request->input('author');
            $blog->status               = $request->input('status'); 
            $blog->save();
             if ($request->hasFile('image')) {
                    $image = $request->file('image');
                   
                      $name = time().'.'.$image->getClientOriginalExtension();
                      $destinationPath = public_path('/uploads/blog/'.$blog->id);
                      $image->move($destinationPath, $name); 
                       $data[]=$name;
                       $blog->image= $name; 
                       $blog->save();
            } 
            DB::commit();
            return redirect()->route('blog.index')->with('success','blog update Successfully.');
        } catch (DecryptException  $e) {
            return redirect()->route('blog.index')->with('error','Request URL does not match.');
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
            $blog = Blog::findOrFail($id); 
            $blog->status = 0; 
            $blog->save(); 
            DB::commit();
            return redirect()->route('blog.index')->with('success','Blog  deActive successfully.');
        } catch (DecryptException  $e) { 
           return redirect()->route('blog.index')->with('error','Request URL does not match.');
        }
    }

    public function blogAjaxList(\App\Http\Requests\DataTableRequest $request){
        if($request->ajax()){
            try {  
                DB::beginTransaction();
                $recordSet = Blog::orderBy('title','ASC');
                if ($request->search['value'] != '') {
                    $recordSet->where('title','LIKE',$request->search['value']."%");
                }
                $recordsTotal = $recordSet->count();
                $blogs = $recordSet->offset($request->start)->limit($request->length)->orderBy('id', 'desc')->get();
                $data = [];
                foreach ($blogs as $key => $blog) {
                    $encryptBlogId = encrypt($blog->id);
                    $action = '';

                    $action .='<a href="'.route('blog.edit',$encryptBlogId).'" class="btn btn-sm btn-icon btn-info mr-2" title="Edit details"> <i class="la la-edit"></i></a>';

                    $action .= '<form action="'.route("blog.destroy", $blog->id).'" method="post" style="display:inline-block; vertical-align: middle; margin: 0;" id="'.$blog->id.'">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="hidden" name="_method" value="DELETE">';
                    $action .='<a href="javascript:;" data-toggle="modal" data-target="#confirmDelete" data-title="Delete" data-message="Are you sure you want to delete this service ?" class="btn btn-sm btn-icon btn-danger" title="Delete"><i class="la la-trash"></i></a>';
                    $action .='</form>';

                    $status = '<span class="badge badge-danger">DEACTIVE</span>';
                    if($blog->status == '1'){
                        $status = '<span class="badge badge-success">ACTIVE</span>';
                        $status = '<i class="fas fa-check text-success"></i>';
                    }

                    $data[] = [
                        str_replace(" ","",tableHeader(0)) =>  $key + 1,
                        str_replace(" ","",tableHeader(1)) => $blog->title,
                        str_replace(" ","",tableHeader(7)) => $blog->blogCat->name,
                        str_replace(" ","",tableHeader(24))  => $blog->summary,
                        str_replace(" ","",tableHeader(5))  => $blog->description,
                        str_replace(" ","",tableHeader(25))  => $blog->author,
                        str_replace(" ","",tableHeader(2))  => $blog->created_at->format('d-m-Y h:i A'),
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
