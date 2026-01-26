<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckValidAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $age = $request->input('age');
        if (!is_numeric($age)) {
            return response()->json(['message' => 'Access denied: Age must be a number.'], 403);
        }
        $age = (int)$age;
        if ($age >= 18) {
            return $next($request);
        } else {
            return response()->json(['message' => 'Access denied: You must be at least 18 years old.'], 403);
        }
    }
}
