<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;

Route::middleware(['dept:Human resources'])
    ->prefix('departments')
    ->name('departments.')
    ->group(function () {

        Route::get('/', [DepartmentController::class,'index'])->name('index');

        // More specific routes should come before the catch-all {department} route
        Route::get('/{department}/assign-employees', [DepartmentController::class, 'assignEmployeesPage'])->name('assign-employees');
        
        Route::post('/{department}/assign-employees', [DepartmentController::class, 'assignEmployees'])->name('assign-employees.submit');

        Route::delete('/{department}/employee/{employee}', [DepartmentController::class, 'removeEmployee'])->name('employee.remove');

        Route::get('/{department}',[DepartmentController::class,'show'])->name('show');

    });
