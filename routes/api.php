<?php

use App\Http\Controllers\Api\InformesController;
use App\Http\Controllers\Api\MarcasController;
use App\Http\Controllers\Api\PersonalController;
use App\Http\Controllers\Api\UbicacionesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(PersonalController::class)->group(function () {
    Route::get('/personal', 'index');
    Route::get('/persona/{id}', 'show');
    Route::post('/persona', 'store');
    Route::post('/login', 'login');
    Route::delete('/persona/{id}', 'destroy');
    Route::put('/persona', 'update');
});

Route::controller(MarcasController::class)->group(function () {
    Route::get('/marca/{id}', 'getMarcaById');
    Route::post('/marcas/get', 'index');
    Route::post('/marca', 'store');
    Route::delete('/marca/{id}', 'destroy');
    Route::put('/marca/{id}', 'update');
    Route::post('/marca/rut', 'addMarcaByRut');
});

Route::controller(InformesController::class)->group(function () {
    Route::post('/informes/general', 'general');
    Route::post('/informes/sap', 'sap');
    Route::post('/informes/general2', 'general2');
});

Route::controller(UbicacionesController::class)->group(function () {
    Route::get('/provincias', 'getProvincias');
    Route::get('/comunas', 'getComunas');
    Route::get('/regiones', 'getRegiones');
});
