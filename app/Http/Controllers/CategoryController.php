<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function list (Request $request) {
        $categories =   Category::latest();
        if(! empty($request->get('keyword')) ){
            $categories = $categories->where('name','like','%'. $request->get('keyword') .'%');
        }
    $categories = $categories->paginate(10);
        return view('profile.backend.category.list',[
            'categories' => $categories,
        ]);
    }
    
    public function create() {
        return view('profile.backend.category.create');
    }
    public function store(Request $request) {

       $validator = Validator::make($request->all(),[
                    'name' => 'required|string',
                    'slug'  =>  'required|string|unique:category',
                ]);

        if($validator->passes()){
            
            $category = new Category();

            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->showHome = $request->showHome;
            $category->save();

            $message = "Category created successfully";
            $request->session()->flash('success',$message);
            return response()->json([
                'status' => true,
                'success' => $message,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }

    public function edit($categoryId, Request $request)
    {
        $category =   Category::find($categoryId);
        if($category==null) {
            $request->flash('error','Category not found.');
            return response()->json([
                'status'    => false,
                'notFound'  => true,
            ]);
            return redirect()->route('categories.index');
        }

        return view('profile.backend.category.edit', compact('category'));
    }

    public function update($categoryId,Request $request) {
        $category = Category::find($categoryId);

        if ($categoryId == null) {
            $request->session()->flash('error','Category Not Found');
            return response()->json([
                'status' => true, 
                'notFound'  =>true,
                'message' => 'Category Not Found'
            ]);
        }
       $validator =  Validator::make($request->all(),[
            'name'   => 'required|string',
            'slug'   => 'required|unique:category,slug,'.$category->id.',id',

        ]);

        if($validator->passes()) {
            $category->name =  $request->name;
            $category->slug =  $request->slug;
            $category->status =  $request->status;
            $category->showHome =  $request->showHome;
            $category->save();

            $request->session()->flash('success','Category Updated Successfully');
                
            return response()->json([
                'status'    => true,
                'message'     =>'Category updated Successfully'
            ]);
        
        } else {
            return response()->json([
                'status'    => false,
                'errors'     => $validator->errors()
            ]);
        }
    }
    public function destroy ($categoryId,Request $request) {
        $category = Category::find($categoryId);
    
        if($category==null) {
            $request->session()->flash('error','Category Not Found');
                return response()->json([
                    'status' => true, 
                    'message' => 'Category Not Found'
                ]);
        }   
            $category->delete();
    
            $request->session()->flash('success', 'Category Deleted Successfully'); 
            return response()->json([
                'status' => true,
                'message' => 'Category deleted Successfully'
            ]);
        }

}
