<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Hash; 
use App\User;
use App\Models\OrderDetails;
use Auth;
use DB;
class UserController extends Controller
{
	  public function myAccount()
	  {
	  	$user=auth()->user();
	  	$orders = OrderDetails::where('user_id',auth()->user()->id)->orderBy('id','DESC')->get();
	   return view('user.profile.myaccount',compact('user','orders'));
	  }

	  public function accountDetail(Request $request)
	  {
        try 
        {
	            DB::beginTransaction();
	             $validator = Validator::make($request->all(),[ 
	                'first_name' => 'required',
	                'middle_name' => 'required',
	                'last_name' => 'required',
	                'mobile_no' => 'required', 
	            ]);
	            if ($validator->fails()) {
	                return back()
	                        ->withErrors($validator)
	                        ->withInput();
	            }  
    
	       		$user  = User::findOrFail(auth()->user()->id);
	            $user->name     = $request->get('first_name').' '. $request->get('last_name');
	            $user->first_name = $request->get('first_name');
	            $user->middle_name = $request->get('middle_name');
	            $user->last_name   = $request->get('last_name');
	            $user->email       = $request->get('email');
	            $user->mobile_no   = $request->get('mobile_no');
	            $user->save();
	            $isProfileUpdate = true;
	            session()->put('isProfileUpdate',$isProfileUpdate);
	            if(!empty($request->get('old_password'))){

		            if (Hash::check($request->get('old_password'), Auth::user()->password)) {
		            	if($request->get('password')==$request->get('conf_password')){
		            		 auth()->user()->update(['password' => Hash::make($request->get('password'))]);
		            	}
		            	else{
		            		 return redirect()->route('user.acount')->with('error','New and Confirm Password Must be Same');
		            	}
		            }
		            else{
						return redirect()->route('user.acount')->with('error','Old Password doesnt Match');
		            }
	            } 
                 DB::commit();
	            return redirect()->route('user.acount')->with('success','Account Detail change  successfully!');
        }catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        } 
	}

	public function orderView($id)
	{
		$orderId=decrypt($id);
        $order=OrderDetails::getOrder($orderId);
		return view('user.profile.order-view',compact('order'));
	}
}
