<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;

Route::group(['prefix' => 'administrator', 'as' => 'admin.'], function () {

    // login user access route
    Route::group(['middleware' => ['auth']], function () {
        Route::get('/', function () {
            return redirect()->route('admin.dashboard');
        });
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resources(['roles' => RoleController::class]);

        Route::resources(['users' => UserController::class]);
    });
});
