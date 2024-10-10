<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;



class role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       
        if (Auth::check() && (Auth::user()->role == 'manager' || Auth::user()->role == 'veterinarian' || Auth::user()->role == 'receptionist')) {
            return $next($request);
        }else
            abort(401);
    }
}
