<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Validator;
use DB;
class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return view('admin.slider.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
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

            $slider                           = new Slider();
            $slider->name                     = $request->input('name');
            $slider->link                     = $request->input('link');
            $slider->text                     = $request->input('text');
            $slider->status                   = $request->input('status'); 
            $slider->save();
              if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $name = time().'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/uploads/slider/'.$slider->id);
                    $image->move($destinationPath, $name); 
                    $slider->image= $name; 
                    $slider->save();
            } 
            DB::commit();
            return redirect()->route('slider.index')->with('success',' Slider create successfully!');

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
            $slider = Slider::find(decrypt($id)); 
            DB::commit();
            return view('admin.slider.edit',compact('slider'));
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
            $slider = Slider::findOrFail(decrypt($id));  
            $slider->name                     = $request->input('name');
            $slider->link                     = $request->input('link');
            $slider->text                     = $request->input('text');
            $slider->status                   = $request->input('status'); 
            $slider->save(); 
            DB::commit();
              if ($request->hasFile('image')) {
                if(!empty($request->file('image'))){
                    $image = $request->file('image');
                    $name = time().'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/uploads/slider/'.$slider->id);
                    $image->move($destinationPath, $name); 
                    $slider->image = $name; 
                    $slider->save();
                }
            } 
            return redirect()->route('slider.index')->with('success','Slider update Successfully.');
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
            $slider = Slider::findOrFail($id);
            $destinationPath = public_path('/uploads/slider/'.$slider->id.'/').$slider->image;

                 if (file_exists($destinationPath)) {

                        @unlink($destinationPath);

                   } 
            $slider->status = 0; 
            $slider->save(); 
            DB::commit();
            return redirect()->route('slider.index')->with('success','Slider  De Active successfully.');
        }catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        } 
    }

    public function sliderAjaxList(\App\Http\Requests\DataTableRequest $request){
        if($request->ajax()){
            try {  
                DB::beginTransaction();
                $recordSet = Slider::orderBy('name','ASC');
                if ($request->search['value'] != '') {
                    $recordSet->where('name','LIKE',$request->search['value']."%");
                }
                $recordsTotal = $recordSet->count();
                $sliders = $recordSet->offset($request->start)->limit($request->length)->orderBy('id', 'desc')->get();
                $data = [];
                foreach ($sliders as $key => $slider) {
                    $encryptsliderId = encrypt($slider->id);
                    $action = '';

                    $action .='<a href="'.route('slider.edit',$encryptsliderId).'" class="btn btn-sm btn-icon btn-info mr-2" title="Edit details"> <i class="la la-edit"></i></a>';

                    $action .= '<form action="'.route("slider.destroy", $slider->id).'" method="post" style="display:inline-block; vertical-align: middle; margin: 0;" id="'.$slider->id.'">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="hidden" name="_method" value="DELETE">';
                    $action .='<a href="javascript:;" data-toggle="modal" data-target="#confirmDelete" data-title="Delete" data-message="Are you sure you want to delete this service ?" class="btn btn-sm btn-icon btn-danger" title="Delete"><i class="la la-trash"></i></a>';
                    $action .='</form>';

                    $status = '<span class="badge badge-danger">DEACTIVE</span>';
                    if($slider->status == '1'){
                        $status = '<span class="badge badge-success">ACTIVE</span>';
                        $status = '<i class="fas fa-check text-success"></i>';
                    }

                    $data[] = [
                        str_replace(" ","",tableHeader(0)) =>  $key + 1,
                        str_replace(" ","",tableHeader(1)) => $slider->name,
                        str_replace(" ","",tableHeader(32)) => $slider->link,
                         str_replace(" ","",tableHeader(33)) => $slider->text,
                        str_replace(" ","",tableHeader(2)) => $slider->created_at->format('d-m-Y h:i A'),
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
}
