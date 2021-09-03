<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Validator;
use DB;
class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return view('admin.banner.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.banner.create');
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
                'text' => 'required',
                'image'=>'required',
            ]);
            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $banner                       = new Banner();
            $banner->banner_name          = $request->input('banner_name');
            $banner->text             = $request->input('text');
            $banner->btn_name         = $request->input('btn_name');
            $banner->link             = $request->input('link');
            $banner->is_home          = $request->input('is_home');
            $banner->status           = $request->input('status'); 
            $banner->save();
            if ($request->hasFile('image')) {
                    $image = $request->file('image');
                   
                      $name = time().'.'.$image->getClientOriginalExtension();
                      $destinationPath = public_path('/uploads/banner/'.$banner->id);
                      $image->move($destinationPath, $name); 
                       $data[]=$name;
                       $banner->image= $name; 
                       $banner->save();
            } 
            DB::commit();
            return redirect()->route('banner.index')->with('success',' Banner create successfully!');

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
            $banner = Banner::find(decrypt($id)); 
            DB::commit();
            return view('admin.banner.edit',compact('banner'));
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
            $banner = Banner::findOrFail(decrypt($id));
            $banner->banner_name          = $request->input('banner_name');
            $banner->text             = $request->input('text');
            $banner->btn_name         = $request->input('btn_name');
            $banner->link             = $request->input('link');
            $banner->is_home          = $request->input('is_home');
            $banner->status           = $request->input('status'); 
            $banner->save();
             if ($request->hasFile('image')) {
                    $image = $request->file('image');
                   
                      $name = time().'.'.$image->getClientOriginalExtension();
                      $destinationPath = public_path('/uploads/banner/'.$blog->id);
                      $image->move($destinationPath, $name); 
                       $data[]=$name;
                       $banner->image= $name; 
                       $banner->save();
            } 
            DB::commit();
            return redirect()->route('banner.index')->with('success','banner update Successfully.');
        } catch (DecryptException  $e) {
            return redirect()->route('banner.index')->with('error','Request URL does not match.');
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
            $banner = Banner::findOrFail($id); 
            $banner->status = 0; 
            $banner->save(); 
            DB::commit();
            return redirect()->route('banner.index')->with('success','Banner  deActive successfully.');
        } catch (DecryptException  $e) { 
           return redirect()->route('banner.index')->with('error','Request URL does not match.');
        }
    }

     public function bannerAjaxList(\App\Http\Requests\DataTableRequest $request){
        if($request->ajax()){
            try {  
                DB::beginTransaction();
                $recordSet = Banner::orderBy('id','desc');
                $recordsTotal = $recordSet->count();
                $banners = $recordSet->offset($request->start)->limit($request->length)->orderBy('id', 'desc')->get();
                $data = [];
                foreach ($banners as $key => $banner) {
                    $encryptBannerId = encrypt($banner->id);
                    $action = '';

                    $action .='<a href="'.route('banner.edit',$encryptBannerId).'" class="btn btn-sm btn-icon btn-info mr-2" title="Edit details"> <i class="la la-edit"></i></a>';

                    $action .= '<form action="'.route("banner.destroy", $banner->id).'" method="post" style="display:inline-block; vertical-align: middle; margin: 0;" id="'.$banner->id.'">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="hidden" name="_method" value="DELETE">';
                    $action .='<a href="javascript:;" data-toggle="modal" data-target="#confirmDelete" data-title="Delete" data-message="Are you sure you want to delete this service ?" class="btn btn-sm btn-icon btn-danger" title="Delete"><i class="la la-trash"></i></a>';
                    $action .='</form>';

                    $status = '<span class="badge badge-danger">DEACTIVE</span>';
                    if($banner->status == '1'){
                        $status = '<span class="badge badge-success">ACTIVE</span>';
                        $status = '<i class="fas fa-check text-success"></i>';
                    }

                    $data[] = [
                        str_replace(" ","",tableHeader(0)) =>  $key + 1,
                        str_replace(" ","",tableHeader(1)) => $banner->banner_name,
                        str_replace(" ","",tableHeader(32)) => $banner->link,
                        str_replace(" ","",tableHeader(33))  => $banner->text,
                        str_replace(" ","",tableHeader(38))  => $banner->btn_name,
                        str_replace(" ","",tableHeader(2))  => $banner->created_at->format('d-m-Y h:i A'),
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
