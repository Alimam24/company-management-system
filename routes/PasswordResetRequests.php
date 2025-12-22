<?php

use App\Http\Controllers\PasswordResetRequestController;
use Illuminate\Support\Facades\Route;

Route::prefix('password-reset-requests')
    ->name('password-reset-requests.')
    ->group(function () {

        Route::get('/', [PasswordResetRequestController::class, 'index'])
        ->name('password-reset-requests.index')
        ->middleware('dept:Human resources');

        Route::post('/{PasswordResetRequest}/approve', [PasswordResetRequestController::class, 'approve'])
        ->name('password-reset-requests.approve')
        ->middleware('dept:Human resources');
        
        Route::post('/{PasswordResetRequest}/deny', [PasswordResetRequestController::class, 'deny'])
        ->name('password-reset-requests.deny')
        ->middleware('dept:Human resources');
    });
