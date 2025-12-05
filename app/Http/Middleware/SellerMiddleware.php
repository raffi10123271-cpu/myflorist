<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SellerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->role !== 'seller') {
            return redirect('/')->with('error', 'Akses khusus seller!');
        }

        return $next($request);
    }
}
