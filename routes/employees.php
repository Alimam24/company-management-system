<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeUserController;
use App\Http\Controllers\PasswordResetRequestController;

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


        Route::get('/{employee}/create-account', [EmployeeUserController::class, 'createAccount'])->name('create-account');
        Route::post('/{employee}/create-account', [EmployeeUserController::class, 'storeAccount'])->name('store-account');
        Route::get('/{employee}/edit-account', [EmployeeUserController::class, 'editAccount'])->name('edit-account');
        Route::patch('/{employee}/update-account', [EmployeeUserController::class, 'updateAccount'])->name('update-account');
        Route::delete('/{employee}/delete-account', [EmployeeUserController::class, 'destroyAccount'])->name('destroy-account');
        
        
    });

