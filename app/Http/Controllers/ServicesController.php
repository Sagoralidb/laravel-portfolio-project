<?php

namespace App\Http\Controllers;

use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServicesController extends Controller
{
   public function index(Request $request) {

    $services = Services::latest();
     if($request->keyword != '') {
       $services = $request->where('title','like', '%' .$request->keyword.'%');
     }

     $services = $services->paginate(10);

    return view('profile.backend.services.list',[
        'services' => $services,
    ]);
   }

   public function create() {
    return view('profile.backend.services.create');
   }

   public function store(Request $request)
   {
       $validator = Validator::make($request->all(), [
           'icon'   => 'required|string',
           'title'  => 'required|unique:services|string|max:255',
           'description' => 'required|string|max:5000',
       ]);
   
       if ($validator->fails()) {
           return response()->json([
               'status' => false,
               'errors' => $validator->errors()
           ], 422);
       }
   
       // Store the data in the database
       $service = new Services();
       $service->icon = $request->icon;
       $service->title = $request->title;
       $service->description = $request->description;
       $service->save();
   
       session()->flash('success','Service created successfully!');
       return response()->json([
           'status' => true,
           'message' => 'Service created successfully!'
       ]);
   }

   public function edit(Request $request, $id) {
     $service =    Services::find($id);

      if($service == null) {
          $message = 'User not found.';     
            session()->flash('error', $message);
            return redirect()->route('list.services');
          }

          return view('profile.backend.services.edit',[
            'service' => $service,
          ]);

      }

      public function update(Request $request, $id) {
        $service = Services::find($id);
    
        if ($service == null) {
            $message = "Service not found";
            session()->flash('error', $message);
            return response()->json([
                'status' => false,
                'message'=> $message,
            ]);
        }
    
        $validator = Validator::make($request->all(), [
            'icon' => 'required|string|unique:services,icon,'.$id,
            'title' => 'required|string|unique:services,title,'.$id,
            'description' => 'required|string|max:5000',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    
        $service->icon = $request->filled('icon') ? $request->icon : $service->icon;
        $service->title = $request->filled('title') ? $request->title : $service->title;
        $service->description = $request->description; 
    
        $service->save();
    
        $message = 'Service updated successfully';
        session()->flash('success', $message);
    
        return response()->json([
            'status' => true,
            'message' => $message,
        ]);
    }
    
    
   public function destroy($id) {
     $service = Services::find($id);

     if($service == null) {
        session()->flash('error','Service not found');

        return response()->json([
            'status' => true,
        ]);
    } 
     $service->delete();
     session()->flash('success','Data deleted successfully');
     return response()->json([
        'status'=> true,
        'success'=>'Data deleted successfully !',
     ]);
   }
   
}
