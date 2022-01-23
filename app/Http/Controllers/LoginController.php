<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        //Esta loggeado
        if(Auth::check()){
            return response()->json([
                'success' => true,
                'message' => "Usted ya ha sido logeado.",
                'data' => null
            ]);
        }

        if (Auth::attempt($credentials, true)) {
            return response()->json([
                'success' => true,
                'message' => "Has sido loggeado, bienvenido.",
                'data' => Auth::user()
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => "El usuario o la contraseña no es correcto.",
            'data' => null
        ], 403);

    }
}
