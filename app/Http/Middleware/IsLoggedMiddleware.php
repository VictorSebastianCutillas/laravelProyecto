<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsLoggedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'No estas loggeado',
                'data'    => null
            ], 401);//401 no estas loggeado 403 no tienes permisos
        }
        return $next($request);
    }
}
