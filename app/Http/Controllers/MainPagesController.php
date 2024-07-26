<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\CustomerOrder;
use Illuminate\Http\Request;
use App\Models\Main;
use App\Models\Portfolio;
use App\Models\User;
use App\Models\VisitorLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class MainPagesController extends Controller
{
    public function dashboard()
    {
        $startDate = Carbon::now()->subMonth();
        $endDate = Carbon::now();
        $visitors = VisitorLog::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('date')
            ->get();
        
        $dates = $visitors->pluck('date');
        $visitorCounts = $visitors->pluck('count');

        $totalUser = User::count();
        $totalClint = User::where('user_type',1)->count();
        $totalAdmin = Admin::count();
        $total_Portfolio_Project = Portfolio::count();
        $totalOrders = CustomerOrder::count();

        return view('profile.backend.dashboard', 
        compact('dates', 'visitorCounts','totalUser','totalClint','totalAdmin','total_Portfolio_Project','totalOrders'));
    }

    public function main()
    {
        $main = Main::first();
        return view('profile.backend.main', compact('main'));  
    }

    public function update(Request $request)
    {
        $request->validate([
            'title'         => 'required|string|max:255', //name         
            'sub_title'     => 'required|string|max:255',
            'full_name'     => 'required|string|max:255', //full name
            'bc_image'      => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'resume'        => 'nullable|file|mimes:pdf,doc,docx|max:5048',
            'profile'       => 'required|string|max:255',  //profile type
            'profile_picture'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email'         => 'required|email',
            'phone'         => 'required|string|max:16',
            'about_me'      => 'required|string|max:5000',
        ]);
    
        $main = Main::firstOrNew(); 
        $main->title     = $request->title;
        $main->sub_title = $request->sub_title;
        $main->full_name = $request->full_name;
        $main->profile   = $request->profile;
        $main->email     = $request->email;
        $main->phone     = $request->phone;
        $main->about_me  = $request->about_me;
    
        if ($request->hasFile('bc_image')) {
            if ($main->bc_image) {
                Storage::disk('public')->delete($main->bc_image);
            }
    
            $image = $request->file('bc_image');
            $imagePath = 'img/' . $image->getClientOriginalName();
            Storage::disk('public')->put($imagePath, file_get_contents($image));
            $main->bc_image = $imagePath; 
        }
    
        if ($request->hasFile('resume')) {
            if ($main->resume) {
                Storage::disk('public')->delete($main->resume);
            }
    
            $resume = $request->file('resume');
            $resumePath = 'pdf/' . $resume->getClientOriginalName();
            Storage::disk('public')->put($resumePath, file_get_contents($resume));
            $main->resume = $resumePath; 
        }
        if ($request->hasFile('profile_picture')) {
            if ($main->profile_picture) {
                Storage::disk('public')->delete($main->profile_picture);
            }
    
            $profile_picture = $request->file('profile_picture');
            $profilePath = 'profile_img/' . $profile_picture->getClientOriginalName();
            Storage::disk('public')->put($profilePath, file_get_contents($profile_picture));
            $main->profile_picture = $profilePath; 
        }
    
        $main->save();
    
        return response()->json([
            'status' => true,
            'message' => 'Main details updated successfully.'
        ]);
    }
     
}
