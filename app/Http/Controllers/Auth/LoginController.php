<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Session;
use Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    /* protected $redirectTo;
     protected function redirectTo(){
        $this->redirectTo = '/admin';
        return $this->redirectTo;
    }*/
    protected $redirectTo;

    protected function redirectTo(){         
        if(Auth::user()->hasRole('Admin')){
            $this->redirectTo = '/admin'; 
            return $this->redirectTo;
        }else {  
            $this->redirectTo = '/'; 
            return $this->redirectTo;
        } 
    }
 
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    } 
    public function logout()
    {
        if(Auth::user()->hasRole('Admin')){
            Auth::logout();
            Session::flush();
            return redirect('login');
        }else {
            Auth::logout();
            Session::flush();
            return redirect('/');
        } 
    }
}
