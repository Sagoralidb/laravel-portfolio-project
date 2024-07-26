<?php

namespace App\Http\Controllers;

use App\Models\CustomerOrder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Ui\Presets\React;
use Illuminate\Support\Facades\Storage;

class EveryUserController extends Controller
{
    public function index(Request $request)
    {
        $users =    User::latest();

        if(! empty($request->get('keyword'))) {
            $users = $users->where('name','like','%'.$request->get('keyword').'%');
            $users = $users->Orwhere('email','like','%'.$request->get('keyword').'%');
            $users = $users->Orwhere('phone','like','%'.$request->get('keyword').'%');
        }
        $users = $users->paginate(5);
        return view('profile.backend.users.list',compact('users'));
    }
    public function create()
    {
        return view('profile.backend.users.create');
    }
    public function store(Request $request) 
    {
      $validator = Validator::make($request->all(),[
        'name'      => 'required',
        'email'     => 'required|email|unique:users',
        'password'  => 'required|min:6',
        'phone'     => 'required|min:11|max:15'
      ]);

      if($validator->passes()) {
        $user = new User();

        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone    = $request->phone;
        $user->status   = $request->status;
        $user->user_type = $request->user_type;
        $user->save();

        session()->flash('success','User added successfully.');
        return response()->json([
            'status'  => true,
            'message' => 'User added successfully.'
          ]);
      } else {
        return response()->json([
            'status'  => false,
            'errors'  => $validator->errors()
          ]);
        }
    }
    public function edit(Request $request, $id) {      
        $user = User::find($id);
        
        if($user == null) {
          $message = 'User not found.';     
            session()->flash('error', $message);
            return redirect()->route('users.index');
        }
    
        return view('profile.backend.users.edit',compact('user'));
       }
    public function updateOrder(Request $request, $id) {
      // this method is created for admin
      $orderUpdate = CustomerOrder::find($id);

      if ($orderUpdate == null) {
        $message ='The order item is not found.';

        session()->flash('error',$message);
        return response()->json([
          'status' => true,
          'message' => $message,
        ]);
      } 

      $validator = Validator::make($request->all(),[
         'title'  => 'required|string',
         'description'=>'required|string|max:5000',
      ]);

      if($validator->passes()) {
        $orderUpdate->user_id  = $request->user_id;
        $orderUpdate->title  = $request->title;
        $orderUpdate->description  = $request->description;
        $orderUpdate->save();

        $message = 'Order updated successfully.';
        session()->flash('success', $message);
        return response()->json([
          'status' => true,
          'message'=> $message,
        ]);
      }

    }
    public function update(Request $request,$id)
    {
        $user = User::find($id);

        if($user== null) {
          $message ='User not found.';

          session()->flash('error',$message);
          return response()->json([
            'status' => true,
            'message' => $message,
          ]);
        }
      $validator = Validator::make($request->all(),[
        'name' => 'required',
        'email'=> 'required|email|unique:users,email,'.$id.',id',
        'phone' => 'required|min:11|max:16|unique:users,phone,'.$id.',id',
      ]);

      if($validator->passes()) {
        $user->name   = $request->name;
        $user->email  = $request->email;
        $user->phone  = $request->phone;

        if($request->password != '') {
          $user->password = Hash::make($request->password);
        }

        $user->status = $request->status;
        $user->user_type = $request->user_type;
        $user->save();

        session()->flash('success','User updated successfully');
        return response()->json([
          'status' => true,
          'message'=> 'User updated successfully.'
        ]);

      } else {
        return response()->json([
          'status' => false,
          'errors' =>$validator->errors(),
        ]);
      }
    
    }
    
    public function destroy($id) {

        $user = User::find($id);
  
        if($user == null) {
          $message = 'User not found';
          session()->flash('error', $message);
  
          return response()->json([
            'status'  => true,
            'message' => $message
          ]);
        }
        $user->delete();
  
        session()->flash('success', 'User Deleted successfully');
        return response()->json([
          'status'  => true,
          'message' => 'User Deleted successfully.'
        ]);
      }

      public function updateUserDashboard(Request $request,$id) {

            $user = User::find($id);
    
            if($user== null) {
              $message ='User not found.';
    
              session()->flash('error',$message);
              return response()->json([
                'status' => true,
                'message' => $message,
              ]);
            }
          $validator = Validator::make($request->all(),[
            'name'    => 'required|string',
            'email'   => 'required|email|unique:users,email,'.$id.',id',
            'phone'   => 'required|min:11|max:16|unique:users,phone,'.$id.',id',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'address' => 'nullable|string|max:350',
          ]);
    
          if($validator->passes()) {
            $user->name   = $request->name;
            $user->email  = $request->email;
            $user->phone  = $request->phone;
            $user->address= $request->address;

            if ($request->hasFile('image')) {
              if ($user->image) {
                  Storage::disk('public')->delete($user->image);
              }
              $image = $request->file('image');
              $profilePath = 'user-profile-img/' . $image->getClientOriginalName();
              Storage::disk('public')->put($profilePath, file_get_contents($image));
              $user->image = $profilePath; 
          }
            $user->save();
    
            session()->flash('success','Profile updated successfully');
            return response()->json([
              'status' => true,
              'message'=> 'Profile updated successfully.'
            ]);
    
          } else {
            return response()->json([
              'status' => false,
              'errors' =>$validator->errors(),
            ]);
          }
        
        }

}
