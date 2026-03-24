<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\AlvaraController;
use App\Models\Documento;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('dashboard'));

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('empresas', EmpresaController::class);
    Route::resource('alvaras', AlvaraController::class);
    Route::resource('users', \App\Http\Controllers\UserController::class)->middleware('plan.limit');
    Route::delete('/documentos/{documento}', [AlvaraController::class, 'destroyDocumento'])->name('documentos.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // API Tokens Management
    Route::post('/profile/tokens', [ProfileController::class, 'storeToken'])->name('profile.tokens.store');
    Route::delete('/profile/tokens/{tokenId}', [ProfileController::class, 'destroyToken'])->name('profile.tokens.destroy');
});

// Admin Routes (SaaS) are now handled by Filament at /admin

require __DIR__.'/auth.php';
