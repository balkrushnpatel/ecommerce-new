<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use DB;
class HomeController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    { 
          return view('admin.user.index');
    }

     public function create()
    { 
          return view('admin.user.create');
    }

     public function userstore(Request $request)
    { 
         try {  
            DB::beginTransaction();
            $validator = Validator::make($request->all(),[
                'first_name' => 'required',
                'last_name' => 'required',
                'email'=>'required',
                'mobile_no'=>'required',
            ]);
            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $user                      = new User();
            $user->name                 = $request->get('first_name').' '. $request->get('last_name');
            $user->first_name           = $request->get('first_name');
            $user->middle_name          = $request->get('middle_name');
            $user->last_name            = $request->get('last_name');
            $user->email                = $request->get('email');
            $user->mobile_no            = $request->get('mobile_no');
            $user->password          = bcrypt($request->get('mobile_no'));
            $user->email_verified_at          = date('Y-m-d H:i:s');
            $user->save();
            $user->assignRole('User');
            if ($request->hasFile('image')) {
                    $image = $request->file('image');
                   
                      $name = time().'.'.$image->getClientOriginalExtension();
                      $destinationPath = public_path('/uploads/user/'.$user->id);
                      $image->move($destinationPath, $name); 
                       $user->image= $name; 
                       $user->save();
            } 
            DB::commit();
            return redirect()->route('admin.userlist')->with('success','  User create successfully!');

        }catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        } 
    }

     public function edit($id){

     	try {
            DB::beginTransaction();
            $user = User::find(decrypt($id)); 
            DB::commit();
            return view('admin.user.edit',compact('user'));
        }catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        }

     }

     public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $user = User::find(decrypt($id)); 
            $user->name                 = $request->get('first_name').' '. $request->get('last_name');
            $user->first_name           = $request->get('first_name');
            $user->middle_name          = $request->get('middle_name');
            $user->last_name            = $request->get('last_name');
            $user->email                = $request->get('email');
            $user->mobile_no            = $request->get('mobile_no');
            $user->password          = bcrypt($request->get('mobile_no'));
            $user->email_verified_at          = date('Y-m-d H:i:s');
            $user->save();
            $user->assignRole('User');
            if ($request->hasFile('image')) {
                    $image = $request->file('image');
                   
                      $name = time().'.'.$image->getClientOriginalExtension();
                      $destinationPath = public_path('/uploads/user/'.$user->id);
                      $image->move($destinationPath, $name); 
                       $user->image= $name; 
                       $user->save();
            } 
            DB::commit();
            return redirect()->route('admin.userlist')->with('success','user update Successfully.');
        } catch (DecryptException  $e) {
            return redirect()->route('admin.userlist')->with('error','Request URL does not match.');
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $user = User::findOrFail($id); 
            $user->status = 0; 
            $user->save(); 
            DB::commit();
            return redirect()->route('admin.userlist')->with('success','Blog  deActive successfully.');
        } catch (DecryptException  $e) { 
           return redirect()->route('admin.userlist')->with('error','Request URL does not match.');
        }
    }

     public function userAjaxList(\App\Http\Requests\DataTableRequest $request){

        if($request->ajax()){
            try {  
                DB::beginTransaction();
                $recordSet = User::role('User')->orderBy('name','ASC');
                if ($request->search['value'] != '') {
                    $recordSet->where('name','LIKE',$request->search['value']."%");
                }
                $recordsTotal = $recordSet->count();
                $users = $recordSet->offset($request->start)->limit($request->length)->orderBy('id', 'desc')->get();
                $data = [];
                foreach ($users as $key => $user) {
                    $encryptuserId = encrypt($user->id);
                    $action = '';

                    $action .='<a href="'.route('admin.useredit',$encryptuserId).'" class="btn btn-sm btn-icon btn-info mr-2" title="Edit details"> <i class="la la-edit"></i></a>';

                    $action .= '<form action="'.route("admin.userdestroy", $user->id).'" method="post" style="display:inline-block; vertical-align: middle; margin: 0;" id="'.$user->id.'">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="hidden" name="_method" value="DELETE">';
                    $action .='<a href="javascript:;" data-toggle="modal" data-target="#confirmDelete" data-title="Delete" data-message="Are you sure you want to delete this service ?" class="btn btn-sm btn-icon btn-danger" title="Delete"><i class="la la-trash"></i></a>';
                    $action .='</form>';


                    $data[] = [
                        str_replace(" ","",tableHeader(0)) =>  $key + 1,
                        str_replace(" ","",tableHeader(27)) => $user->first_name,
                        str_replace(" ","",tableHeader(28))  => $user->middle_name,
                        str_replace(" ","",tableHeader(29))  => $user->last_name,
                        str_replace(" ","",tableHeader(30))  => $user->email,
                        str_replace(" ","",tableHeader(31))  => $user->mobile_no,
                        str_replace(" ","",tableHeader(2))  => $user->created_at->format('d-m-Y h:i A'),
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
