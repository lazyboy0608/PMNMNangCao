<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

class CheckTimeAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $now = Carbon::now();
        $start = Carbon::parse('09:00:00'); // 9 AM
        $end = Carbon::parse('23:00:00'); // 11 PM
        if($now->between($start, $end)) {
            return $next($request);
        } else {
            return response()->json([
                'message' => 'Access denied: Outside of allowed time range (9 AM - 11 PM).',
                'time' => $now->format('H:i:s')
            ], 403);
        }
    }
}
