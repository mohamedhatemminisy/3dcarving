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
        Route::resource('customers', 'App\Http\Controllers\Dashboard\CustomersController');
        Route::resource('units', 'App\Http\Controllers\Dashboard\UnitsController');
        Route::resource('categories', 'App\Http\Controllers\Dashboard\CategoriesController');
        Route::resource('machines', 'App\Http\Controllers\Dashboard\MachinesController');
        Route::resource('mach_types', 'App\Http\Controllers\Dashboard\MachTypesController');
        Route::resource('orders', 'App\Http\Controllers\Dashboard\OrdersController');

        Route::post('price', 'App\Http\Controllers\Dashboard\OrdersController@updatePrice')
        ->name('update.price');
        Route::post('price_status', 'App\Http\Controllers\Dashboard\OrdersController@updatePriceStatus')
        ->name('update.price.status');
        Route::post('order_status', 'App\Http\Controllers\Dashboard\OrdersController@order_status')
        ->name('order.status');
        Route::post('order_designer', 'App\Http\Controllers\Dashboard\OrdersController@order_designer')
        ->name('order.designer');
        Route::post('update_order_status', 'App\Http\Controllers\Dashboard\OrdersController@update_order_status')
        ->name('update.design.status');
        Route::post('order_accountant', 'App\Http\Controllers\Dashboard\OrdersController@order_accountant')
        ->name('order.accountant');
        Route::post('order_material', 'App\Http\Controllers\Dashboard\OrdersController@order_material')
        ->name('order.material');
        Route::post('operation_status', 'App\Http\Controllers\Dashboard\OrdersController@operation_status')
        ->name('update.operation.status');
        Route::post('order_machine', 'App\Http\Controllers\Dashboard\OrdersController@order_machine')
        ->name('order.machine');
        

        Route::get('profile/edit', 'App\Http\Controllers\Dashboard\ProfileController@editProfile')
            ->name('edit.profile');
        Route::put('profile/update', 'App\Http\Controllers\Dashboard\ProfileController@updateprofile')
            ->name('update.profile');
        Route::get('logout', 'App\Http\Controllers\Dashboard\LoginController@logout')->name('admin.logout');
    });
});
