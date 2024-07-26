<?php

namespace App\Http\Controllers;

use App\Models\VisitorLog;
use Carbon\Carbon;

class VisitorController extends Controller
{
    public function index() {
        // মাসিক ইউনিক ভিজিটর কনট
        $startDate = Carbon::now()->subMonth();
        $endDate = Carbon::now();
        
        $dailyVisitorCounts = VisitorLog::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date')
            ->selectRaw('COUNT(DISTINCT ip_address) as unique_count')
            ->groupBy('date')
            ->get();

        $dates = $dailyVisitorCounts->pluck('date');
        $visitorCounts = $dailyVisitorCounts->pluck('unique_count');

        // পেজিনেটেড ভিজিটর
        $visitors = VisitorLog::latest()->paginate(10);

        // মোট ইউনিক ভিজিটর সংখ্যা
        $totalUniqueVisitors = VisitorLog::distinct('ip_address')->count();

        $data = [
            'visitors' => $visitors,
            'dates' => $dates,
            'visitorCounts' => $visitorCounts,
            'totalVisitors' => $totalUniqueVisitors, // মোট ইউনিক ভিজিটর সংখ্যা
            'dailyVisitorCounts' => $dailyVisitorCounts,
        ];

        return view('profile.backend.visitors.index',$data);
    }
}
