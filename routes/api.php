<?php

use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\IsLoggedMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('alumno')
    ->group(function (){
        Route::get('', [AlumnoController::class, 'getAll']);
        Route::middleware(["AsegurarIdNumericoEnteroPositivo", IsLoggedMiddleware::class])->group(function() {
                Route::post('', [AlumnoController::class, 'insert']);

                Route::get('/{id}', [AlumnoController::class, 'getAlumno']);

                Route::delete('/{id}', [AlumnoController::class, 'deleteAlumno']);

                Route::patch('/{id}', [AlumnoController::class, 'updateAlumno']);
        });
    });

Route::post('login', [LoginController::class, 'authenticate']);
