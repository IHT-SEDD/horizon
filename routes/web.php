<?php

use App\Http\Controllers\Master\MasterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Sales\SalesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    #region Master
    Route::prefix('master')->group(function () {
        Route::get('/{model}', [MasterController::class, 'index']);
        Route::get('/{model}/datatable', [MasterController::class, 'datatable']);
        Route::get('/{model}/select', [MasterController::class, 'select']);
        Route::post('/{model}/add', [MasterController::class, 'create']);
    });

    #region Sales
    Route::prefix('sales')->group(function () {
        Route::get('/', [SalesController::class, 'index']);
        Route::get('/datatable', [SalesController::class, 'datatable']);
        Route::get('/add-new', [SalesController::class, 'newSalePage']);
    });
});

require __DIR__ . '/auth.php';
