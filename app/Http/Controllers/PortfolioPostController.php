<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Gallery;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
class PortfolioPostController extends Controller

{
   public function index() {
    $posts = Portfolio::with('images')         //images is the hashMany relationship in Portfolio.php model
                ->select('portfolios.*', 'category.name as category_name','portfolios.clint')
                ->leftJoin('category', 'category.id', '=', 'portfolios.category_id')
                ->orderBy('portfolios.id','DESC')
                ->paginate(10);
    $data['posts']      = $posts;
    return view('profile.backend.portfolio-post.list', $data);
   }

   public function create() {
    $data       =  [];
    $categories =    Category::orderBy('name','ASC')->get();
    $posts  =   Portfolio::all();

    $data['categories'] = $categories;
    $data['posts'] = $posts;
    return view('profile.backend.portfolio-post.create',$data);
   }

    public function store(Request $request)
    {
        $rules = [
            'title'         => 'required',
            'slug'          => 'required|unique:portfolios',
            'category_id'   => 'required',
            'post_type'     => 'required|in:project,blog',
            'tags'          => 'required|array',
            'tags.*'        => 'string|max:50',
            'images.*'      => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
           
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }

        $portfolio = Portfolio::create([
            'title'             => $request->title,
            'slug'              => $request->slug,
            'short_description' => $request->short_description,
            'description'       => $request->description,
            'clint'             => $request->clint,
            'project_url'       => $request->project_url,
            'category_id'       => $request->category_id,
            'tags'              => implode(',', $request->tags),
            'status'            => $request->status,
            'showHome'          => $request->showHome,
            'post_type'         => $request->post_type,
        ]);

        if ($request->hasFile('images')) {
            $images = $request->file('images');
        
        foreach ($images as $image) {
            $imagePath = 'images_file/' . $image->getClientOriginalName();
            Storage::disk('public')->put($imagePath, file_get_contents($image));
            // Associate images with portfolio using saveMany()
            $portfolio->images()->saveMany([
                new Gallery(['images' => $imagePath])
                ]);
            }
        }

            $message = "Post created successfully.";
            session()->flash('success', $message);
            return response()->json([
                'status'  => true,
                'message' => $message,
            ]);
    }

    public function removeTag(Request $request)
    {
        $portfolioId = $request->input('portfolio_id');
        $tagToRemove = $request->input('tag');
        $portfolio = Portfolio::find($portfolioId);
        if (!$portfolio) {
            return response()->json(['error' => 'Portfolio not found'], 404);
        }
        $tags = json_decode($portfolio->tags, true); 
        if (!is_array($tags)) {
            $tags = [];
        }
        $updatedTags = array_diff($tags, [$tagToRemove]);
        $portfolio->tags = json_encode($updatedTags);
        $portfolio->save();
        return response()->json(['success' => 'Tag removed successfully'], 200);
    }
    

   public function edit(Request $request,$id) {
       $portfolios = Portfolio::find($id);
     
    
       if($portfolios == null) {
        session()->flash('error', 'Item no found');
        return redirect()->route('list.portfolio');
    }

    // $categories = Category::where('category_id',$portfolios->category_id);
    $categories      =   Category::orderBy('name','ASC')->get();
    $images =   Gallery::where('portfolio_id',$portfolios->id);

    $relatedPosts =[];
     if($portfolios->related_post!='') {
        $postArray =explode(',',$portfolios->related_post);
        $relatedPosts = Portfolio::whereIn('id',$postArray)->with('images')->get();
     }

     $data =    [];
     $data['portfolios']    = $portfolios;
     $data['categories']    = $categories;
     $data['images']        = $images;
    
    return view('profile.backend.portfolio-post.edit',$data);

   }

   public function update(Request $request, $id) {

    $portfolio = Portfolio::find($id);

    if($portfolio == null) {
        $message = 'Item not found';
        session()->flash('error',$message);
        return response()->json([
            'status' => false,
            'error' => $message,
        ]);
    }
       $rules = [
           'title'         => 'required',
           'slug'          => 'required|unique:portfolios,slug,' . $id,
           'category_id'   => 'required',
           'post_type'     => 'required|in:project,blog',
           'tags'          => 'required|array',
           'tags.*'        => 'string|max:50',
           'images.*'      => 'image|mimes:jpeg,png,jpg,gif,svg|max:5048',
       ];
   
       $validator = Validator::make($request->all(), $rules);
   
       if ($validator->fails()) {
           return response()->json([
               'status' => false,
               'errors' => $validator->errors(),
           ]);
       }
       $portfolio->title    = $request->title;
       $portfolio->slug     = $request->slug;
       $portfolio->short_description = $request->short_description;
       $portfolio->description = $request->description;
       $portfolio->clint        = $request->clint;
       $portfolio->project_url  = $request->project_url;
       $portfolio->category_id  = $request->category_id;
       $portfolio->tags         = implode(',', $request->tags);
       $portfolio->status       = $request->status;
       $portfolio->showHome     = $request->showHome;
       $portfolio->post_type    = $request->post_type;
   
       if ($request->hasFile('images')) {
           $portfolio->images()->delete();
           $images = $request->file('images');
           foreach ($images as $image) {
               $imagePath = 'images_file/' . $image->getClientOriginalName();
               Storage::disk('public')->put($imagePath, file_get_contents($image));
               $portfolio->images()->saveMany([
                   new Gallery(['images' => $imagePath])
               ]);
           }
       }

       $portfolio->save();
   
       $message = "Post updated successfully.";
       session()->flash('success', $message);
   
       return response()->json([
           'status'  => true,
           'message' => $message,
       ]);
   }
   

   public function destroy($id) {

    $post = Portfolio::find($id);

            if (!$post) {
                return response()->json([
                    'status' => false,
                    'message' => 'Post not found',
                ], 404);
            }

            $post->delete();
            session()->flash('success','Post deleted successfully');
            return response()->json([
                'status' => true,
                'message' => 'Post deleted successfully',
            ]);
        }


   }



