<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\VisitorLog;
use Illuminate\Support\Facades\Log;

class LogVisitor
{
    public function handle(Request $request, Closure $next)
    {
        Log::info('Visitor Log Middleware Triggered');

        VisitorLog::create([
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
            'url' => $request->fullUrl(),
        ]);

        return $next($request);
    }
}
