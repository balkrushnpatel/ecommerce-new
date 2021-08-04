<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

use Auth;
use App\User;
use Illuminate\Http\Request;
use Validator;
use DB;
use Mail; 
class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);

        $validatedData['password'] = bcrypt($request->password); 
        $user = User::create($validatedData);   
        $accessToken = $user->createToken('authToken')->accessToken; 
        return response([ 'user' => $user, 'access_token' => $accessToken]);
    }

    public function login(Request $request)
    {	
    	 $validator = Validator::make($request->all(), [ 
            'email' => 'email|required',
            'password' => 'required'
        ]);
		if ($validator->fails()) { 
			$response['status'] = false;
			$response['error'] = $validator->errors();
		    return response()->json($response, 401);            
		}  
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
        	$user = Auth::user();
    	    $tokenResult = $user->createToken('Personal Access Token'); 
            $token = $tokenResult->token;
            $token->save();   
	    	$response['status'] = true;
			$response['data'] = [
				'name'         => $user->name,  
				'role'         => $user->roles->first()->name, 
				'access_token' => $tokenResult->accessToken, 
			]; 
        }else{
        	$response['status'] = false;
			$response['error'] = 'Invalid Credentials';
        } 
        
        return response($response);
    }    
    public function resetPassword(Request $request) {
        $validator = Validator::make($request->all(), [ 
            'email' => ['required', 'string', 'email', 'max:255']
        ]);
        if ($validator->fails()) { 
            $response['status'] = false;
            $response['error'] = $validator->errors();
            return response()->json($response, 401);            
        } 
        $userDetails = User::where('email', $request->email)->first();

        if(!$userDetails) {
            $response['status'] = false;
            $response['error'] = "Invalid email address";
        } else {          
            try { 
                DB::beginTransaction(); 
                $otp = $this->generateOtp(6);
                $this->sendMail($userDetails, $otp); 
                $updateArray['otp']        = $otp;
                User::whereId($userDetails->id)->update($updateArray);

                DB::commit();

                $response['status'] = true;
                $response['success'] = "Mail successfully sent with reset password link";

            } catch (\Exception $e) {
                DB::rollback();
                $response['status'] = false;
                $response['error'] = $e->getMessage();
            }
        }

        return response($response);
    }

    /**
    *@ Method: sendMail
    *@ Description: send mail for reset password
    *@ Used In: resetPassword mehod
    */
    public function sendMail($userDetails, $otp)
    {        
        $encryptedOTP = Crypt::encryptString($otp);

        $userDetail                     =   [];
        $userDetail['mail_subject']     =   "Reset Password";
        $userDetail['otp']              =   $encryptedOTP;
        $userDetail['email']            =   $userDetails->email;
        $userDetail['user_detail']      =   $userDetails;

        Mail::send(new PasswordResetMail($userDetail));
    }

    /**
    *@ Method: resetNewPassword
    *@ Description: reset password page 
    *@ Route: GET method, url '/api/reset-password/{otp}'
    */
    public function resetNewPassword($otp)
    {
        $decryptOTP = Crypt::decryptString($otp);
        $user = User::where('otp', $decryptOTP)->first();
        if(!$user) {
            $response['status'] = false;
            $response['data'] = [
                'message'      => 'Password reset link is invalid', 
            ]; 
        } else {
            $response['status'] = true;
            $response['data'] = [
                'name'         => $user->name,
                'otp'          => $otp,
                'message'      => 'password reset link a-ok', 
            ]; 
        }
        return response($response);
    } 

    /**
    *@ Method: updatePassword
    *@ Description: update password
    *@ Route: GET method, url '/api/update-password'
    */
    public function updatePassword(Request $request)
    {
         $validator = Validator::make($request->all(), [ 
            'otp'           => 'required', 
        ]);
        if ($validator->fails()) { 
            $response['status'] = false;
            $response['error'] = $validator->errors();
            return response()->json($response, 401);            
        } 

        $decryptOTP = Crypt::decryptString($request->otp);
        $user = User::where('otp', $decryptOTP)->first();

        $updateArray['otp']        = "";
        $updateArray['password']   = bcrypt($request->new_password);
        $updatePsw = User::whereId($user->id)->update($updateArray);

        if($updatePsw) {
            $response['status'] = true;
            $response['success'] = "password updated";
        } else {
            $response['status'] = false;
            $response['error'] = "Something went wrong";
        }
        return response($response);
    } 
   
    public function updateResetPassword(Request $request)
    {
         $validator = Validator::make($request->all(), [ 
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required'],
            'new_password' => ['required']
        ]);
        
        if ($validator->fails()) { 
            $response['status'] = false;
            $response['error'] = $validator->errors();
            return response()->json($response, 401);            
        }  
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            try {
                $userDetailsUpdate = User::where('email', $request->email)->
                update(['password' => bcrypt($request->new_password)]);
                $response['status'] = true;
                $response['message'] = "Password Updated";

            } catch (\Exception $e) {
                DB::rollback();
                $response['status'] = false;
                $response['message'] = $e->getMessage();
            }         
        } else {          
            $response['status'] = false;
            $response['message'] = "Invalid old password";
            
        }
        return response($response);
    }
    public function changePassword(Request $request){
        $validator = Validator::make($request->all(), [ 
            'old_password'    => 'required',
            'new_password'    => 'required',
            'confirm_password'    => 'required',
        ]);
        if ($validator->fails()) {
            $response['status'] = false;
            $response['message'] = $validator->errors();
            return response()->json($response, 401);
        }
        try {
            DB::beginTransaction();
            $oldPassword = $request->old_password;
            $newPassword = $request->new_password;
            $confirmPassword = $request->confirm_password;
            $userId =  Auth::user()->id;

            if(!empty($oldPassword)){
                if($newPassword == $confirmPassword){ 
                    $user = User::where('id', $userId)->where('password',bcrypt($oldPassword))->get(); 
                    if(count($user) > 0){  
                        $updateArray['password']   = bcrypt($newPassword);
                        $updatePsw = User::whereId($userId)->update($updateArray); 
                         
                        $response['status'] = true;
                        $response['success'] = "Password change successfully"; 
                    }else{
                        $response['status'] = false;
                        $response['message'] = "Please try again";
                    } 
                }else{
                    $response['status'] = false;
                    $response['message'] = "New password and confirm password not match";
                }
            }else{
                $response['status'] = false;
                $response['message'] = "Old Password can not empty";
            }
        } catch (\Exception $e) {
            DB::rollback();
            $response['status'] = false;
            $response['message'] = $e->getMessage();
        } 
        return response($response);
    }
    public function viewProfile(Request $request){ 
        try {
            DB::beginTransaction(); 
            $user =  Auth::user();
            $userData = array( 
                'name'=>$user->name,
                'first_name'=>$user->first_name,
                'last_name'=>$user->last_name,
                'middle_name'=>($user->middle_name)?$user->middle_name:'',
                'phone'=>($user->phone)?$user->phone:'',
                'email'=>$user->email, 
            );
            DB::commit();
            $response['status'] = true;
            $response['message'] = "Detail fetch successfully";
            $response['data'] = $userData;
        } catch (\Exception $e) {
            DB::rollback();
            $response['status'] = false;
            $response['message'] = $e->getMessage();
        } 
        return response($response);
    }
    public function updateProfile(Request $request){ 
        try {
            DB::beginTransaction(); 
            $validator = Validator::make($request->all(), [ 
                'first_name'    => 'required',
                'last_name'    => 'required',
                'phone'    => 'required',
            ]);
            if ($validator->fails()) {
                $response['status'] = false;
                $response['message'] = $validator->errors();
                return response()->json($response, 401);
            }
            $updateData = array( 
                'name'=>$request->name.''.$request->last_name,
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'middle_name'=>$request->middle_name,
                'phone'=>$request->phone,  
            ); 
            User::whereId(Auth::user()->id)->update($updateData);
            DB::commit();
            $response['status'] = true;
            $response['message'] = "Profile update successfully";
        } catch (\Exception $e) {
            DB::rollback();
            $response['status'] = false;
            $response['message'] = $e->getMessage();
        } 
        return response($response);
    }
}
