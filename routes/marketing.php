<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarketingController;

Route::middleware(['dept:Marketing & customer contact'])
    ->prefix('marketing')
    ->name('marketing.')
    ->group(function () {

        // Marketing Employee Assignment Routes
        Route::get('/customers/{customer}/assign-employee', [MarketingController::class, 'assignEmployeePage'])
            ->name('assign-employee');
        Route::post('/customers/{customer}/assign-employee', [MarketingController::class, 'assignEmployee'])
            ->name('assign-employee.submit');
        Route::delete('/customers/{customer}/remove-employee', [MarketingController::class, 'removeEmployee'])
            ->name('remove-employee');

        // Offers Management Routes
        Route::get('/offers', [MarketingController::class, 'offersIndex'])->name('offers.index');
        Route::get('/offers/create', [MarketingController::class, 'createOffer'])->name('offers.create');
        Route::post('/offers', [MarketingController::class, 'storeOffer'])->name('offers.store');
        Route::get('/offers/{offer}', [MarketingController::class, 'showOffer'])->name('offers.show');
        Route::get('/offers/{offer}/edit', [MarketingController::class, 'editOffer'])->name('offers.edit');
        Route::patch('/offers/{offer}', [MarketingController::class, 'updateOffer'])->name('offers.update');
        Route::delete('/offers/{offer}', [MarketingController::class, 'destroyOffer'])->name('offers.destroy');

        // Offer Assignment Routes
        Route::get('/offers/{offer}/assign', [MarketingController::class, 'assignOfferPage'])->name('offers.assign');
        Route::post('/offers/{offer}/assign', [MarketingController::class, 'assignOffer'])->name('offers.assign.submit');
        Route::delete('/offers/{offer}/customers/{customer}', [MarketingController::class, 'removeOfferFromCustomer'])
            ->name('offers.remove-customer');

    });

