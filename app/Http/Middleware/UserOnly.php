<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth('admin')->check() || Auth('teacher')->check()){
            return redirect()->route('home')->with([
                'error' => "Teachers/Admin aren't allowed to do this action"
            ]);
        }
        return $next($request);
    }
}
