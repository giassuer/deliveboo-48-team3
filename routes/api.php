<?php

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('Api')->group(function () {

    Route::get('/restaurants', 'RestaurantController@index');
    Route::get('/restaurants/{restaurant}', 'RestaurantController@show');
    Route::get('/payments', 'PaymentController@generate');
    Route::post('/payments', 'PaymentController@makepayment');
    Route::apiResource('orders', 'OrderController');
    Route::get('/categories','CategoryController@getCategories');
});

