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

        Route::get('/{warehouse}/employees', [WarehouseController::class, 'listEmployees'])
            ->name('employees');
            
        Route::delete('/{warehouse}/employee/{employee}', [WarehouseController::class, 'destroyemp'])
            ->name('employee.destroy');

        Route::get('/{warehouse}/assign-employees', [WarehouseController::class, 'assignEmployeesPage'])
            ->name('employees.assign.page');

        Route::post('/{warehouse}/assign-employees', [WarehouseController::class, 'assignSelectedEmployees'])
            ->name('employees.assign.submit');

        Route::get('/{warehouse}/assign-manager', [WarehouseController::class, 'assignManagerPage'])
            ->name('manager.assign.page');

        Route::post('/{warehouse}/assign-manager', [WarehouseController::class, 'assignManager'])
            ->name('manager.assign.submit');

        Route::delete('/{warehouse}/manager', [WarehouseController::class, 'removeManager'])
            ->name('manager.remove');
    });
