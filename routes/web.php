<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::middleware('auth')
    ->namespace('Admin')
    ->name('admin.')
    ->prefix('admin')
    ->group(function() {
        Route::get('/', 'RestaurantController@index')->name('home');
        Route::resource('restaurants','RestaurantController');
        Route::resource('dishes','DishController');
        
        Route::get('/orders/trash', 'OrderController@trash')->name('orders.trash');
        Route::get('/orders', 'OrderController@index')->name('orders.index');
        Route::get('/orders/{order}', 'OrderController@show')->name('orders.show');
        Route::delete('/orders/{order}', 'OrderController@destroy')->name('orders.destroy');
        Route::patch('/orders/{order}/restore', 'OrderController@restore')->name('orders.restore');

    });

    Route::get('/restaurants/{restaurant}', function () {
        return view('guests.menu');
    });

    Route::get('{any?}', function() {
		return view('guests.home');
	})->where('any', '.*');


