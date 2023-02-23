<?php

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Users Routes
|--------------------------------------------------------------------------
|
| Here is where you can register users routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "users" middleware group. Now create something great!
|
*/

Route::group([
    'middleware' => ['auth'],
    'controller' => UsersController::class
], function () {
    
    // Create, read, update, edit and delete users
    Route::group(['prefix' => 'auth'], function () {
        Route::resource('users', UsersController::class)->except(['show']);
    });

    // Recycle Users
    Route::group(['prefix' => 'temp'], function () {
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', 'recycle')->name('users.recycle');
            Route::get('/restore/{id}', 'restore');
            Route::post('/restore-all', 'restoreAll');
            Route::delete('/delete/{id}', 'delete');
            Route::delete('/delete-all', 'deleteAll');
        });
    });

    // Users Password
    Route::post('/users/reset/{id}', 'reset')->name('users.reset');
    Route::get('/change-password', 'changePassword')->name('users.password');

    // Users Name
    Route::get('/change-name', 'changeName');
});
