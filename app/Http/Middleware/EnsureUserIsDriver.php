<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Add this line
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class EnsureUserIsDriver
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user() && Auth::user()->isDriver()) {
            return $next($request);
        }
        return response()->json(['message' => 'Unauthorized'], 403);
    }
}
