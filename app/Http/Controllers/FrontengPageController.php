<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Main;
use App\Models\Services;
use App\Models\Portfolio;
use App\Models\Category; // Import the Category model
use Carbon\Carbon;

class FrontengPageController extends Controller
{
    public function homepage()
    {
        $mains = Main::first(); 
        $homeServices = Services::all(); 
        $portfolioData = Portfolio::with(['images', 'category'])->get(); 
        $categories = Category::all(); 

        $startDate = Carbon::create(2024, 1, 10);
        $currentDate = Carbon::now();
        $diff = $startDate->diff($currentDate);

        $years = $diff->y;
        $months = $diff->m;
        $days = $diff->d;
    
        return view('profile.frontend.home', compact('mains', 'homeServices', 'portfolioData', 'categories','years', 'months', 'days'));
    }

    
    
    public function allServices() {
        $mains       = Main::first();
        $homeServices    = Services::all();
        $homeServices    = Services::paginate(12);
        return view('profile.frontend.all-service',[
            'mains' => $mains,
            'homeServices'=> $homeServices,
        ]);
    }

    public function OpensinglePageService($id) {

        $mains          = Main::first();
        $homeServices    = Services::all();
        $singleServicePost = Services::with('service_ratings.user')->find($id);
        if(! $singleServicePost) {
            abort(404);
        }
        $reviews        = $singleServicePost->service_ratings;
        $totalReviews   = $reviews->count();
        $averageRating  = number_format($totalReviews > 0 ? $reviews->avg('rating') : 0,2);
        $avgRatingPercentage = ($averageRating*100)/5;
      

        $data['mains'] =  $mains;
        $data['singleServicePost']   = $singleServicePost;
        $data['homeServices']        = $homeServices;
        $data['reviews']             = $reviews;
        $data['totalReviews']        = $totalReviews;
        $data['averageRating']       = $averageRating;
        $data['avgRatingPercentage'] = $avgRatingPercentage;
        return view('profile.frontend.single-service-page', $data);
    }
    
    public function portfolio_details(Request $request, $id) {

        $portfolioData = Portfolio::with(['images', 'category'])->findOrFail($id); 
        $categories = Category::all(); 

        if ($portfolioData->project_url && !filter_var($portfolioData->project_url, FILTER_VALIDATE_URL)) {
            $portfolioData->project_url = 'http://' . $portfolioData->project_url;
        }
        
        return view('profile.frontend.single-portfolio-details', compact('portfolioData', 'categories'));
    }
}

