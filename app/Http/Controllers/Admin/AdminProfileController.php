<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Hash; 
use App\User;
use Auth;
class AdminProfileController extends Controller
{
    public function edit()
    { 
    	$user=auth()->user();
        return view('admin.profile.profile',compact('user'));
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    { 
       $validator = Validator::make($request->all(),[ 
                'first_name' => 'required', 
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
        return back()->withStatus(__('Profile successfully updated.'));
    }

    public function password(Request $request)
    {
      /*  auth()->user()->update(['password' => Hash::make($request->get('password'))]);*/
     if(!empty($request->get('old_password'))){

                if (Hash::check($request->get('old_password'), Auth::user()->password)) {

                    if($request->get('password')==$request->get('conf_password')){
                  
                          auth()->user()->update(['password' => Hash::make($request->get('password'))]);
                    }
                    else{
                       
                         return redirect()->route('profile.edit')->with('error','New and Confirm Password Must be Same');
                    }
                }
                else{
                    
                    return redirect()->route('profile.edit')->with('error','Old Password doesnt Match');
                }
        } 

        return back()->withStatusPassword(__('Password successfully updated.'));
    }
}
