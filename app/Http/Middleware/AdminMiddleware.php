<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user() && auth()->user()->role !== 'admin') {
            return redirect('home'); // Redirect non-admin users to home page
        }

        return $next($request); // Allow admin to proceed
    }
}
