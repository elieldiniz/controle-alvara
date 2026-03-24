<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AlvaraController;
use App\Http\Controllers\Api\EmpresaController;
use App\Http\Controllers\Api\ApiAuthController;

// Rotas públicas (estritamente para autenticação se necessário via token)
Route::post('/login', [ApiAuthController::class, 'login']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Todas as rotas de recursos protegidas por Sanctum
Route::middleware('auth:sanctum')->name('api.')->group(function () {
    Route::post('/logout', [ApiAuthController::class, 'logout']);
    Route::apiResource('alvaras', AlvaraController::class);
    Route::apiResource('empresas', EmpresaController::class);
});
