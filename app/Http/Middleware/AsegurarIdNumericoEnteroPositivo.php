<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AsegurarIdNumericoEnteroPositivo
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
        $arr = ['id' => $request->id];
        $valida = Validator::make($arr, [
            'id' => 'integer|numeric|min:1'
        ]);
        if ($valida->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'El id pasado no es correcto',
                'data' => null
            ], 422);
        }

        /*
            $request->validate([
                'id' => 'integer|numeric|min:1'
            ]);
        */
        return $next($request);
    }
}
