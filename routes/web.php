<?php

use App\Http\Controllers\Master\MasterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Sales\SalesController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

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
        // Main page
        Route::get('/', [SalesController::class, 'index']);
        Route::get('/datatable', [SalesController::class, 'datatable']);

        // Add new data page
        Route::get('/add-new', [SalesController::class, 'newSalePage']);
        Route::get('/add-new/products/details', [SalesController::class, 'getProductDetail']);
        Route::post('/add-new/insert-data', [SalesController::class, 'insertSalesOrder']);

        // Detail page
        Route::get('/detail/{id}', [SalesController::class, 'detailSalesOrderPage']);
        Route::get('/detail/{id}/data', [SalesController::class, 'detailSalesOrder']);
        Route::get('/detail/{id}/datatable', [SalesController::class, 'dtSalesOrderProduct']);

        // Update status
        Route::get('/detail/{id}/confirm', [SalesController::class, 'confirmSalesOrder']);
        Route::get('/detail/{id}/cancel', [SalesController::class, 'cancelSalesOrder']);
        Route::get('/detail/{id}/lock', [SalesController::class, 'lockSalesOrder']);

        // Print
        Route::get('/detail/{id}/print', [SalesController::class, 'printSalesOrder']);

        // Export
        Route::get('/detail/{id}/export', [SalesController::class, 'exportSalesOrder']);
    });
});

require __DIR__ . '/auth.php';
