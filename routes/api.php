<?php

use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\TypeController;
use App\Http\Controllers\Api\RestaurantController;
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

//Types
Route::get('/types', [TypeController::class, 'index']);
Route::get('/types/{slug}', [TypeController::class, 'show']);
//Restaurants
Route::get('/restaurants', [RestaurantController::class, 'index']);
Route::get('/restaurants/{slug}', [RestaurantController::class, 'show']);
//Orders
Route::get('/orders/generate', [OrderController::class, 'generate']);
Route::post('/orders/make/payment', [OrderController::class, 'makePayment']);
