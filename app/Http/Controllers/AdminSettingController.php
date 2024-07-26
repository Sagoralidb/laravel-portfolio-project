<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminSettingController extends Controller
{
    public function index(Request $request)
    {
        $admins =    Admin::latest();

        if(! empty($request->get('keyword'))) {
            $admins = $admins->where('name','like','%'.$request->get('keyword').'%');
            $admins = $admins->Orwhere('email','like','%'.$request->get('keyword').'%');
        }
        $admins = $admins->paginate(5);
        return view('profile.backend.admin.list',compact('admins'));
    }
    public function create()
    {
        return view('profile.backend.admin.create');
    }
    public function storeAdmin(Request $request) 
    {
      $validator = Validator::make($request->all(),[
        'name'      => 'required',
        'email'     => 'required|email|unique:admins',
        'password'  => 'required|min:6',
      ]);

      if($validator->passes()) {
        $user = new Admin();

        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $message = 'Admin added successfully.' ;
        session()->flash('success',$message);
        return response()->json([
            'status'  => true,
            'message' => $message,
          ]);
      } else {
        return response()->json([
            'status'  => false,
            'errors'  => $validator->errors()
          ]);
        }
    }
    public function editAdmin(Request $request, $id) {      
        $admin = Admin::find($id);
        
        if($admin == null) {
          $message = 'Admin not found.';     
            session()->flash('error', $message);
            return redirect()->route('list.admin');
        }
    
        return view('profile.backend.admin.edit',compact('admin'));
       }

       public function updateAdmin(Request $request, $id)
{
    $admin = Admin::find($id);

    if ($admin == null) {
        $message = 'Admin not found.';
        session()->flash('error', $message);
        return response()->json([
            'status' => true,
            'message' => $message,
        ]);
    }

    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|email|unique:admins,email,' . $id . ',id',
        'phone' => 'nullable' // Comment out this line if it exists
    ]);

    if ($validator->passes()) {
        $admin->name = $request->name;
        $admin->email = $request->email;

        if ($request->password != '') {
            $admin->password = Hash::make($request->password);
        }
        $admin->save();

        session()->flash('success', 'Admin updated successfully');
        return response()->json([
            'status' => true,
            'message' => 'Admin updated successfully.'
        ]);

    } else {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors(),
        ]);
    }
}

    public function destroyAdmin($id) {

        $admin = Admin::find($id);
  
        if($admin == null) {
          $message = 'Admin not found';
          session()->flash('error', $message);
  
          return response()->json([
            'status'  => true,
            'message' => $message
          ]);
        }
        $admin->delete();
  
        session()->flash('success', 'Admin Deleted successfully');
        return response()->json([
          'status'  => true,
          'message' => 'Admin Deleted successfully.'
        ]);
      }


}
