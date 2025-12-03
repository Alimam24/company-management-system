<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;

Route::middleware(['dept:Retail Store Management'])
    ->prefix('stores')
    ->name('stores.')
    ->group(function () {

        Route::get('/', [StoreController::class,'index'])->name('index');
        Route::get('/create', [StoreController::class,'create'])->name('create');
        Route::post('/', [StoreController::class,'store'])->name('store');

        Route::get('/{store}/edit', [StoreController::class, 'edit'])->name('edit');
        Route::patch('/{store}', [StoreController::class, 'update'])->name('update');

        Route::get('/{store}', [StoreController::class, 'show'])->name('show');
        Route::delete('/{store}', [StoreController::class, 'destroy'])->name('destroy');

        Route::get('/{store}/employees',[StoreController::class,'listemployees'])->name('employees');
        Route::delete('/{store}/employee/{employee}', [StoreController::class, 'destroyemp'])->name('employee.destroy');
    });
