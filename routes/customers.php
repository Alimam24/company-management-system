<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

Route::middleware(['dept:Marketing & customer contact'])
    ->prefix('customers')
    ->name('customers.')
    ->group(function () {

        Route::get('/', [CustomerController::class,'index'])->name('index');
        Route::get('/create', [CustomerController::class,'create'])->name('create');
        Route::post('/', [CustomerController::class,'store'])->name('store');
        Route::get('/{customer}/edit', [CustomerController::class, 'edit'])->name('edit');
        Route::patch('/{customer}', [CustomerController::class, 'update'])->name('update');
        Route::get('/{customer}', [CustomerController::class, 'show'])->name('show');
        Route::delete('/{customer}', [CustomerController::class, 'destroy'])->name('destroy');
    });
