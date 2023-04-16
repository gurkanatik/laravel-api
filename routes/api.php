<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserContactsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register')->name('register');
    Route::post('/login', 'login')->name('login');
});

Route::middleware('auth:api')->group(function () {

    Route::controller(UserContactsController::class)
        ->name('userContacts.')
        ->prefix('user-contacts')
        ->group(function () {
            Route::get('/search', 'search')->name('search');
            Route::get('/{id}', 'show')->name('show');
            Route::get('/{limit?}', 'index')->name('get');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'delete')->name('delete');
            Route::post('/', 'store')->name('store');
        });

});

