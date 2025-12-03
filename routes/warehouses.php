<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WarehouseController;

Route::middleware(['dept:Warehouse Management'])
    ->prefix('warehouses')
    ->name('warehouses.')
    ->group(function () {

        Route::get('/', [WarehouseController::class,'index'])->name('index');
        Route::get('/create', [WarehouseController::class,'create'])->name('create');
        Route::post('/', [WarehouseController::class,'store'])->name('store');

        Route::get('/{warehouse}/edit', [WarehouseController::class, 'edit'])->name('edit');
        Route::patch('/{warehouse}', [WarehouseController::class, 'update'])->name('update');

        Route::get('/{warehouse}', [WarehouseController::class, 'show'])->name('show');
        Route::delete('/{warehouse}', [WarehouseController::class, 'destroy'])->name('destroy');

    });
