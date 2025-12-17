<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

Route::prefix('profile')
    ->name('profile.')
    ->group(function () {

        Route::get('/', [ProfileController::class,'index'])->name('index');

        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');

        // Route::get('/{employee}', [ProfileController::class, 'show'])->name('show');
        // Route::delete('/{employee}', [ProfileController::class, 'destroy'])->name('destroy');

        // Route::get('/{employee}/change-role', [ProfileController::class, 'changeRole'])->name('change-role')->can('manage');
        // Route::patch('/{employee}/change-role', [ProfileController::class, 'updateRole'])->name('update-role')->can('manage');

    });

