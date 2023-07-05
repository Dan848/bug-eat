<?php

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

Route::get('/types', [TypeController::class, 'index']);
Route::get('/types/{slug}', [TypeController::class, 'show']);
Route::get('/restaurants', [RestaurantController::class, 'index']);
Route::get('/restaurants/{slug}', [RestaurantController::class, 'show']);
