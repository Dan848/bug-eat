<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Restaurant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $startMonth = Carbon::now()->subMonths(11)->startOfMonth();
        $endMonth = Carbon::now()->timezone('Europe/Rome');
        $orders = Order::select(
            DB::raw('DATE_FORMAT(date_time, "%Y-%m") AS month'),
            DB::raw('COUNT(*) AS total'),
            DB::raw('SUM(total_price) AS price'),
            'restaurants.name AS restaurant_name',
            'restaurants.id AS restaurant_id'
        )
            ->join('order_product', 'orders.id', '=', 'order_product.order_id')
            ->join('products', 'order_product.product_id', '=', 'products.id')
            ->join('restaurants', 'products.restaurant_id', '=', 'restaurants.id')
            ->where('date_time', '>=', $startMonth)
            ->where('date_time', '<=', $endMonth)
            ->whereHas('products.restaurant.user', function ($query) {
                $query->where('id', auth()->id());
            })
            ->groupBy('restaurant_id', 'restaurant_name', 'month')
            ->get();

        $user_id = Auth::id();
        $restaurants = Restaurant::where('user_id', $user_id)->with('types')->get();
        return view('admin.dashboard', compact("restaurants", "orders"));
    }
}
