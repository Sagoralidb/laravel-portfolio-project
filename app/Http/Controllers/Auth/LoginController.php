<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function showLoginForm() {
        return view('profile.customer.login.login');
    }
    public function processLogin(Request $request) {
     $validator = Validator::make($request->all(),[
        'email' =>['required','string','email','max:255'],
        'password'=>['required','string','min:6'],
     ]);
     if($validator->fails()) {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()->toArray(),
        ]);
     }
     $credentials = $request->only('email','password');
        if(Auth::attempt($credentials)) {
            session()->flash('success','Login successfull');
            return response()->json([
                'status' => true,
                'message' =>'Login successfull'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => [
                    'email' => 'These credentials do not match our records.',
                    'password' => 'Incorrect password.'
                ]
            ]);
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login.user');
    }
    public function userDashboard(){
        return view('profile.frontend.user_dashboard.dashboard');
    }
}
