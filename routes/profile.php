<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('profile')
    ->name('profile.')
    ->group(function () {

        Route::get('/', [ProfileController::class, 'index'])->name('index');

        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');

        Route::get('/change-password', [ProfileController::class, 'showChangePasswordForm'])->name('change-password.form');
        Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('change-password');

    });
