<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is an admin
        if (!Auth::check() || !Auth::user()->isAdmin) {
            return redirect('/admin/login'); // Redirect to login or another page
        }

        return $next($request);
    }
}
