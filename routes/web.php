<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
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
    //Restaurants
    Route::resource('restaurants', RestaurantController::class)->parameters(["restaurants" => "restaurant:slug"]);
    //Types
    Route::resource('types', TypeController::class)->parameters(["types" => "type:slug"]);
    //Products
    Route::get('/menu/{restaurant:slug}', [ProductController::class, "index"])->name("menu.index");
    Route::resource('products', ProductController::class)->parameters(["products" => "product:slug"]);
    //Orders
    Route::get('/sales/{restaurant:slug}', [OrderController::class, 'index'])->name('sales.index');
    Route::get('/orders/statistics', [OrderController::class, 'getChartData'])->name('orders.statistics');

    Route::get('/orders/{order:id}', [OrderController::class, 'show'])->name('orders.show');


    //PRODUCTS ROUTE


    // //Store
    // Route::post('/products', [ProductController::class, "store"])->name("products.store");

    // //Create
    // Route::get('/products/create', [ProductController::class, "create"])->name("products.create");

    // //Index
    // Route::get('/products/{restaurant}', [ProductController::class, "index"])->name("products.index");

    // //Update
    // Route::put('/products/{product:slug}', [ProductController::class, "update"])->name("products.update");

    // //Show
    // Route::get('/products/{product:slug}', [ProductController::class, "show"])->name("products.show");

    // //Destroy
    // Route::delete('/products/{product:slug}', [ProductController::class, "destroy"])->name("products.destroy");

    // //Edit
    // Route::get('/products/{product:slug}/edit', [ProductController::class, "edit"])->name("products.edit");
});

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';
