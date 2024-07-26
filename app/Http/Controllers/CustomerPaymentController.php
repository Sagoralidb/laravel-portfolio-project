<?php

namespace App\Http\Controllers;

use App\Models\CustomerPayment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CustomerPaymentController extends Controller
{
    public function store(Request $request) {
       $validator  = Validator::make($request->all(),[
            'order_id'      => 'required',
            'project_cost'  => 'required|min:3',
            'amount'        => 'required|min:3',
            'tranjection_id'=> 'required|min:11',
            'pay_slip'      => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if($validator->passes()) {
            $payment = new CustomerPayment();

            $payment->user_id    = $request->user_id;
            $payment->order_id   = $request->order_id;
            $payment->project_cost   = $request->project_cost;
            $payment->payment_type   = $request->payment_type;
            $payment->amount         = $request->amount;
            $payment->pay_method     = $request->pay_method;
            $payment->tranjection_id = $request->tranjection_id;

            if ($request->hasFile('pay_slip')) {
                $image = $request->file('pay_slip');
                $imagePath = 'paymentIMG/' . $image->getClientOriginalName();
                Storage::disk('public')->put($imagePath, file_get_contents($image));
                $payment->pay_slip = $imagePath; 
            }
            

            $payment->save();

             $message ="Payment details submitted successfully. wait for the review";
             session()->flash('success',$message);
            return response()->json([
                'status'   => true,
                'message'  => $message,
            ]);
        } else {
           
            return response()->json([
                'status'   => false,
                'errors'  => $validator->errors()
            ]);
    }
  }
  public function showPaymentList() {
    $userInfo = User::all();
    $paymentInfo = CustomerPayment::all();
    return view('profile.backend.payment.index',compact('userInfo','paymentInfo'));
  }
 


}
