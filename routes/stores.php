<?php

use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;

Route::middleware(['dept:Retail Store Management'])
    ->prefix('stores')
    ->name('stores.')
    ->group(function () {

        Route::get('/', [StoreController::class, 'index'])->name('index');
        Route::get('/create', [StoreController::class, 'create'])->name('create');
        Route::post('/', [StoreController::class, 'store'])->name('store');

        Route::get('/{store}/edit', [StoreController::class, 'edit'])->name('edit');
        Route::patch('/{store}', [StoreController::class, 'update'])->name('update');

        Route::get('/{store}', [StoreController::class, 'show'])->name('show');
        Route::delete('/{store}', [StoreController::class, 'destroy'])->name('destroy');

        Route::get('/{store}/employees', [StoreController::class, 'listemployees'])
            ->name('employees');
            
        Route::delete('/{store}/employee/{employee}', [StoreController::class, 'destroyemp'])
            ->name('employee.destroy');

        Route::get('/{store}/assign-employees', [StoreController::class, 'assignEmployeesPage'])
            ->name('employees.assign.page');

        Route::post('/{store}/assign-employees', [StoreController::class, 'assignSelectedEmployees'])
            ->name('employees.assign.submit');

        Route::get('/{store}/assign-manager', [StoreController::class, 'assignManagerPage'])
            ->name('manager.assign.page');

        Route::post('/{store}/assign-manager', [StoreController::class, 'assignManager'])
            ->name('manager.assign.submit');

        Route::delete('/{store}/manager', [StoreController::class, 'removeManager'])
            ->name('manager.remove');
    });
