<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeCategory;
use Validator;
use DB;
class HomeCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $homecategory=HomeCategory::get();
         return view('admin.homecategory.create',compact('homecategory')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('admin.homecategory.create');
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
                
            ]);
            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            } 
            if(isset($request['home_cat']) && !empty($request['home_cat'])){
                foreach($request['home_cat'] as $category){ 
                    if(isset($category['id']) && !empty($category['id'])){
                        $homecategory =HomeCategory::findOrFail($category['id']);
                    }else{
                        $homecategory = new HomeCategory();
                    }
                    $homecategory->cat_id =  $category['cat_id'];
                    $homecategory->banner_id =  $category['banner_id'];
                    $homecategory->save(); 
                }  
           }
           
            DB::commit();
            return redirect()->route('homecategory.index')->with('success',' Homecategory create successfully!');

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
      
    }

      public function delete(Request $request){
        $id = $request->input('id');
        if($id){
            $homecat = HomeCategory::where('id',$id)->delete();
            if( $homecat ){
                $response['success'] = true; 
            }else{
                $response['success'] = false; 
            }
            return response()->json($response);
        }else{
            return redirect()->route('homecategory.index')->with('error','Please try again');
        }
    }
}
