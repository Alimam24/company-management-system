<?php

use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasswordResetRequestController;

Route::middleware('guest')->group(function () {
    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);

    Route::get('/password-reset-requests/create', [PasswordResetRequestController::class, 'create'])
        ->name('password-reset-requests.create')
        ->middleware('guest');

        Route::post('/password-reset-requests', [PasswordResetRequestController::class, 'store'])
        ->name('password-reset-requests.store')
        ->middleware('guest');
});

Route::middleware('auth')->group(function () {

    Route::post('/logout', [SessionController::class, 'destroy']);
    
    Route::get('/', function () {
        $stats = [
            'employees' => \App\Models\employee::count(),
            'customers' => \App\Models\customer::count(),
            'products' => \App\Models\product::count(),
            'stores' => \App\Models\retail_store::count(),
            'warehouses' => \App\Models\warehouse::count(),
        ];
        return view('home', compact('stats'));
    });

    
    require __DIR__.'/employees.php';
    require __DIR__.'/customers.php';
    require __DIR__.'/stores.php';
    require __DIR__.'/warehouses.php';
    require __DIR__.'/products.php';
    require __DIR__.'/departments.php';
    require __DIR__.'/marketing.php';
    require __DIR__.'/profile.php';
    require __DIR__.'/PasswordResetRequests.php';

});
