<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

Route::middleware(['dept:Human resources'])
    ->prefix('employees')
    ->name('employees.')
    ->group(function () {

        Route::get('/', [EmployeeController::class,'index'])->name('index');
        Route::get('/create', [EmployeeController::class,'create'])->name('create');
        Route::post('/', [EmployeeController::class,'store'])->name('store');

        Route::get('/{employee}/edit', [EmployeeController::class, 'edit'])->name('edit');
        Route::patch('/{employee}', [EmployeeController::class, 'update'])->name('update');

        Route::get('/{employee}', [EmployeeController::class, 'show'])->name('show');
        Route::delete('/{employee}', [EmployeeController::class, 'destroy'])->name('destroy');

        Route::get('/{employee}/change-role', [EmployeeController::class, 'changeRole'])->name('change-role')->can('manage');
        Route::patch('/{employee}/change-role', [EmployeeController::class, 'updateRole'])->name('update-role')->can('manage');


    });

