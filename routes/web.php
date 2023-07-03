<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TypeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home');
})->name('home');


Route::middleware(["auth", "verified"])->name("admin.")->prefix("admin")->group(function () {
    Route::get("/", [DashboardController::class, "index"])->name("dashboard");
    Route::resource('restaurants', RestaurantController::class)->parameters(["restaurants" => "restaurant:slug"]);
    Route::resource('products', ProductController::class)->parameters(["products" => "product:slug"]);
    Route::resource('types', TypeController::class)->parameters(["types" => "type:slug"]);
});

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';
