<?php

namespace App\Http\Controllers;

use App\Models\Services;
use App\Models\ServicesRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class RatingsController extends Controller

{
    public function saveRating(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'comment' => 'required|string|max:1000',
            'rating'  => 'required|integer|min:1|max:5',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
        $count = ServicesRating::where('user_id',$request->user_id)->count();
        if($count > 2) {
            session()->flash('error', "You already rated this service 2 times");
            return response()->json([
                'status' => true,
            ]);
        }
        $serviceRatings = new ServicesRating();
        $serviceRatings->user_id      = $request->user_id;
        $serviceRatings->services_id  = $id;
        $serviceRatings->rating       = $request->rating;
        $serviceRatings->comment      = $request->comment;
        $serviceRatings->save();

        $message = "Rating submitted successfully, wait for the admin approval";
        session()->flash('success', $message);
        return response()->json([
            'status' => true,
            'message' => $message,
        ]);
    }

    public function indexRatings() {

        $ratings =ServicesRating::with(['user','service'])->latest()->paginate(10);
        return view('profile.backend.ratings.list',[
            'ratings'=> $ratings, 
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $rating = ServicesRating::find($id);

        if (!$rating) {
            return response()->json(['success' => false, 'message' => 'Rating not found.']);
        }

        $rating->status = $request->input('status');
        $rating->save();

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully!'
        ]);
    }
}

