<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use Validator;
use DB;
class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return view('admin.language.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.language.create');
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

            $language                       = new Language();
            $language->name                 = $request->input('name');
            $language->status               = $request->input('status'); 
            $language->save();
            DB::commit();
            return redirect()->route('language.index')->with('success',' Language create successfully!');

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
            $language = Language::find(decrypt($id)); 
            DB::commit();
            return view('admin.language.edit',compact('language'));
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
            $language = Language::findOrFail(decrypt($id));
            $language->name              = $request->input('name');
            $language->status            = $request->input('status'); 
            $language->save();
            DB::commit();
            return redirect()->route('language.index')->with('success','Language update Successfully.');
        } catch (DecryptException  $e) {
            return redirect()->route('language.index')->with('error','Request URL does not match.');
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
            $language = Language::findOrFail($id); 
            $language->status = 0; 
            $language->save(); 
            DB::commit();
            return redirect()->route('language.index')->with('success','Language deActive successfully.');
        } catch (DecryptException  $e) { 
           return redirect()->route('language.index')->with('error','Request URL does not match.');
        }
    }

    public function languageAjaxList(\App\Http\Requests\DataTableRequest $request){
        if($request->ajax()){
            try {  
                DB::beginTransaction();
                $recordSet = Language::orderBy('name','ASC');
                if ($request->search['value'] != '') {
                    $recordSet->where('name','LIKE',$request->search['value']."%");
                }
                $recordsTotal = $recordSet->count();
                $languages = $recordSet->offset($request->start)->limit($request->length)->orderBy('id', 'desc')->get();
                $data = [];
                foreach ($languages as $key => $language) {
                    $encryptLanguageId = encrypt($language->id);
                    $action = '';

                    $action .='<a href="'.route('language.edit',$encryptLanguageId).'" class="btn btn-sm btn-icon btn-info mr-2" title="Edit details"> <i class="la la-edit"></i></a>';

                    $action .= '<form action="'.route("language.destroy", $language->id).'" method="post" style="display:inline-block; vertical-align: middle; margin: 0;" id="'.$language->id.'">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="hidden" name="_method" value="DELETE">';
                    $action .='<a href="javascript:;" data-toggle="modal" data-target="#confirmDelete" data-title="Delete" data-message="Are you sure you want to delete this service ?" class="btn btn-sm btn-icon btn-danger" title="Delete"><i class="la la-trash"></i></a>';
                    $action .='</form>';

                    $status = '<span class="badge badge-danger">DEACTIVE</span>';
                    if($language->status == '1'){
                        $status = '<span class="badge badge-success">ACTIVE</span>';
                        $status = '<i class="fas fa-check text-success"></i>';
                    }

                    $data[] = [
                        str_replace(" ","",tableHeader(0))  => $key + 1,
                        str_replace(" ","",tableHeader(1))  => $language->name,
                        str_replace(" ","",tableHeader(2))  => $language->created_at->format('d-m-Y h:i A'),
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
