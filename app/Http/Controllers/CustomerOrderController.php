<?php

namespace App\Http\Controllers;

use App\Models\CustomerOrder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerOrderController extends Controller
{
    public function store(Request $request) {
       $validator = Validator::make($request->all(),[
            'title'         => 'required|string',
            'description'   => 'required|string|max:5000',
        ]);

        if ($validator->passes()) {
            $customerOrder =    new CustomerOrder();

            $customerOrder->user_id      = $request->user_id;
            $customerOrder->title        = $request->title;
            $customerOrder->description  = $request->description;
            $customerOrder->budget       = $request->budget;
            $customerOrder->save();

            $message = "Order submitted successfull; your order is in review, please wait for the admin response";
            session()->flash('success',$message);
            return response()->json([
                'status' => true,
                'message' => $message,
            ]);
        } else {
            return response()->json([
                'status'=>false,
                'errors' => $validator->errors()
            ]);
        }
       
    }

    public function OrderList() {
        $getCustomerOrders = CustomerOrder::with('user')->latest()->get();
        return view('profile.backend.orders.list', [
            'getCustomerOrders' => $getCustomerOrders,
        ]);
    }

    public function OrderCreate() 
    {
        $users =  User::all();
        return view('profile.backend.orders.create',[
            'users' => $users,
        ]);
    }

    public function editOrder(Request $request, $id) {
        // This method is created for admin
        // $orderEdit = CustomerOrder::find($id);
        $orderEdit = CustomerOrder::find($id);

        if($orderEdit == null) {
            $message = "Order not found.";

            session()->flash('error', $message);
            return redirect()->route('order.list');
        }
        return view('profile.backend.orders.edit',compact('orderEdit'));
    }

    public function deleteOrder($id) 
    {
        $orderDelete =   CustomerOrder::find($id);

        if($orderDelete == null) {
            $message = 'Order not found';
         
            session()->flash('error', $message);
            return response()->json([
                'status'  => true,
                'message' => $message
            ]);
        } $orderDelete->delete();

        session()->flash('success', 'Order deleted successfully');
        return response()->json([
          'status'  => true,
          'message' => 'Order deleted successfully.'
        ]);
    }
}
