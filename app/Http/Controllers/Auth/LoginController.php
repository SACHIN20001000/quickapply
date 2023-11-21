<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
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
    public function redirectTo()
    {
      
        if(auth()->user()){
            $user_id = auth()->user()->id;
            $expiration_time = time() + (60 * 60 * 24 * 365 * 10); // 10 years
            // Set the cookie
            setcookie('user_id', $user_id, $expiration_time, '/');
                
        }
            return '/admin/dashboard';
        
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

    public function logout(Request $request)
    {
        setcookie('user_id', '', time() - 3600, '/');

        $user = Auth::user();
        if ($user->hasRole('Admin'))
        {
            $redirect =  '/admin';
        } else if ($user->hasRole('IotAdmin'))
        {

            $redirect = '/iot-admin';
        } else
        {

            $redirect  = '/';
        }
        Auth::logout();
        return redirect($redirect);
    }

}
