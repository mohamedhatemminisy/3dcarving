<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {


    Route::get('admin/login', 'App\Http\Controllers\Dashboard\LoginController@login')
        ->name('admin.login');
    Route::post('admin/login', 'App\Http\Controllers\Dashboard\LoginController@postLogin')
        ->name('admin.post.login');

    Route::group(['middleware' => ['auth', 'permission'], 'prefix' => 'admin'], function () {

        Route::get('/', 'App\Http\Controllers\Dashboard\DashboardController@index')->name('admin.dashboard');

        Route::resource('users', 'App\Http\Controllers\Dashboard\UserController');
        Route::resource('roles', 'App\Http\Controllers\Dashboard\RolesController');
        Route::resource('permissions', 'App\Http\Controllers\Dashboard\PermissionsController');
        Route::resource('parties', 'App\Http\Controllers\Dashboard\PartiesController');
        Route::resource('donations', 'App\Http\Controllers\Dashboard\DonationsController');

        
        Route::get('profile/edit', 'App\Http\Controllers\Dashboard\ProfileController@editProfile')
            ->name('edit.profile');
        Route::put('profile/update', 'App\Http\Controllers\Dashboard\ProfileController@updateprofile')
            ->name('update.profile');
        Route::get('logout', 'App\Http\Controllers\Dashboard\LoginController@logout')->name('admin.logout');
    });
});
