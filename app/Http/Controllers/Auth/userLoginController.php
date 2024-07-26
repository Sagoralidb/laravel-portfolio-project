<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\CustomerOrder;
use App\Models\CustomerPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class userLoginController extends Controller
{
    
    
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
        return redirect()->route('login.user')->with('success','You are logged out successfully.');
    }

    public function userDashboard(){
        $userId = auth('web')->user()->id;

     $getCustomerOrder =  CustomerOrder::where('user_id',$userId)->latest()->get();
     $getCustomerPaymentDetails = CustomerPayment::where('user_id',$userId)->latest()->get();
     
        return view('profile.frontend.user_dashboard.dashboard',[
            'getCustomerOrder'  => $getCustomerOrder,
            'getCustomerPaymentDetails' => $getCustomerPaymentDetails,
        ]);
    }

    public function showChangePasswordForm() {
        return view('profile.frontend.user_dashboard.change-password');
    }
}
