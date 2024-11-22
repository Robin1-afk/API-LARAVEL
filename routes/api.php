<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NegocioController;
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

// Rutas públicas
Route::middleware('api')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::get('allNegocios', [NegocioController::class, 'indexNegocios']);
});

// Rutas protegidas (requiere JWT)
Route::middleware('auth:api')->group(function () {
    // Rutas accesibles para roles específicos (role:1, 2, 3)
    Route::middleware('role:1')->group(function () {
        //Metodo que actualiza los negocios registrados en la BD
        Route::put('update_negocio/{id}',[NegocioController::class, 'updateNegocios']);
        //Ruta que registra los Negocios
        Route::post('register_negocio',[NegocioController::class, 'storeNegocios']);
        //Ruta que se encarga de consultar todos los negocios en la BD
        
        //Ruta que se encarga de registrar los usuarios
        Route::post('register', [AuthController::class, 'storeUser']);
    });
});
