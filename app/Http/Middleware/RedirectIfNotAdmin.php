<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->role != 2) {
            return redirect('/adminLogin');
        }

        return $next($request);
    }
}
