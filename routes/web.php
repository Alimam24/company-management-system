<?php

use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);
});
Route::post('/logout', [SessionController::class, 'destroy']);

Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return view('home');
    });

   // Route::get('/profile',[SessionController::class,'show'])->name('profile');

    require __DIR__.'/employees.php';
    require __DIR__.'/customers.php';
    require __DIR__.'/stores.php';
    require __DIR__.'/warehouses.php';
    require __DIR__.'/products.php';
        require __DIR__.'/profile.php';

});

