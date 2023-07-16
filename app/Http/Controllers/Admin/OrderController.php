<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {
        $orders = Order::with('products.restaurant.user')
            ->whereHas('products.restaurant.user', function ($query) {
                $query->where('id', auth()->id());
            })->paginate(15);

        return view('admin.orders.index', compact('orders'));
    }

    public function getChartData()
    {
        $startMonth = Carbon::now()->subMonths(12)->startOfMonth();
        $endMonth = Carbon::now()->subMonths(1)->endOfMonth();
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

        //Riusciamo a prendere i nomi dei ristoranti
        $restaurants = Restaurant::where('user_id', auth()->id())->with('products.orders')->get();

        // $results = DB::table('restaurants')
        //     ->select(
        //         'restaurants.name as restaurant_name',
        //         DB::raw('YEAR(orders.date_time) as year'),
        //         DB::raw('MONTH(orders.date_time) as month'),
        //         DB::raw('COUNT(DISTINCT orders.id) as order_count'),
        //         DB::raw('SUM(orders.total_price) as total_price')
        //     )
        //     ->join('products', 'products.restaurant_id', '=', 'restaurant.id')
        //     ->join('order_product', 'products.id', '=', 'order_product.product_id')
        //     ->join('orders', 'order_product.order_id', '=', 'orders.id')
        //     ->groupBy('restaurants.id')
        //     ->orderBy('restaurants.name')
        //     ->get();

        return view('admin.orders.statistics', compact('orders', 'restaurants'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     */
    public function store(StoreOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     *
     */
    public function show(Order $order)
    {
        // if ($order->products->isNotEmpty() && $order->products->first()->restaurant->user_id != Auth::id()) {
        //     abort(403);
        // }
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \App\Models\Order  $order
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param  \App\Models\Order  $order
     */
    public function destroy(Order $order)
    {
        //
    }
}