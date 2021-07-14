<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use Validator;
use DB;
class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.package.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.package.create');
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

            $package                           = new Package();
            $package->name                     = $request->input('name');
            $package->description              = $request->input('description');
            $package->price                    = $request->input('price');
            $package->validity                 = $request->input('validity');
            $package->status                   = $request->input('status'); 
            $package->save();
              if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $name = time().'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/uploads/package/'.$package->id);
                    $image->move($destinationPath, $name); 
                    $package->image= $name; 
                    $package->save();
            } 
            DB::commit();
            return redirect()->route('package.index')->with('success',' Package create successfully!');

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
            $package = Package::find(decrypt($id)); 
            DB::commit();
            return view('admin.package.edit',compact('package'));
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
            $package = Package::findOrFail(decrypt($id));  
            $package->name                     = $request->input('name');
            $package->description              = $request->input('description');
            $package->price                    = $request->input('price');
            $package->validity                 = $request->input('validity');
            $package->status                   = $request->input('status'); 
            $package->save();
            DB::commit();
             if ($request->hasFile('image')) {
                if(!empty($request->file('image'))){
                    $image = $request->file('image');
                    $name = time().'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/uploads/package/'.$package->id);
                    $image->move($destinationPath, $name); 
                    $package->image = $name; 
                    $package->save();
                }
            } 
            return redirect()->route('package.index')->with('success','Package update Successfully.');
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
            $package = Package::findOrFail($id);
            $destinationPath = public_path('/uploads/package/'.$package->id.'/').$package->image;

                 if (file_exists($destinationPath)) {

                        @unlink($destinationPath);

                   } 
            $package->status = 0; 
            $package->save(); 
            DB::commit();
            return redirect()->route('package.index')->with('success','Package  De Active successfully.');
        }catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        } 
    }

    public function packageAjaxList(\App\Http\Requests\DataTableRequest $request){
        if($request->ajax()){
            try {  
                DB::beginTransaction();
                $recordSet = Package::orderBy('name','ASC');
                if ($request->search['value'] != '') {
                    $recordSet->where('name','LIKE',$request->search['value']."%");
                }
                $recordsTotal = $recordSet->count();
                $packages = $recordSet->offset($request->start)->limit($request->length)->orderBy('id', 'desc')->get();
                $data = [];
                foreach ($packages as $key => $package) {
                    $encryptpackageId = encrypt($package->id);
                    $action = '';

                    $action .='<a href="'.route('package.edit',$encryptpackageId).'" class="btn btn-sm btn-icon btn-info mr-2" title="Edit details"> <i class="la la-edit"></i></a>';

                    $action .= '<form action="'.route("package.destroy", $package->id).'" method="post" style="display:inline-block; vertical-align: middle; margin: 0;" id="'.$package->id.'">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="hidden" name="_method" value="DELETE">';
                    $action .='<a href="javascript:;" data-toggle="modal" data-target="#confirmDelete" data-title="Delete" data-message="Are you sure you want to delete this service ?" class="btn btn-sm btn-icon btn-danger" title="Delete"><i class="la la-trash"></i></a>';
                    $action .='</form>';

                    $status = '<span class="badge badge-danger">DEACTIVE</span>';
                    if($package->status == '1'){
                        $status = '<span class="badge badge-success">ACTIVE</span>';
                        $status = '<i class="fas fa-check text-success"></i>';
                    }

                     if($package->validity=='1')
                     {
                        $validity='3 Months';
                     }
                     else if($package->validity=='2')
                     {
                        $validity='6 Months';
                     }
                     else if($package->validity=='3')
                     {
                        $validity='12 Months';
                     }

                    $data[] = [
                        str_replace(" ","",tableHeader(0)) =>  $key + 1,
                        str_replace(" ","",tableHeader(1)) => $package->name,
                        str_replace(" ","",tableHeader(5)) => $package->description,
                          str_replace(" ","",tableHeader(6)) => $package->price,
                        str_replace(" ","",tableHeader(21))=>$validity,
                      
                        str_replace(" ","",tableHeader(2)) => $package->created_at->format('d-m-Y h:i A'),
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
