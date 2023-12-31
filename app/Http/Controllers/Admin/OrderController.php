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
    public function index($slug)
    {

        $restaurant = Restaurant::where('slug', $slug)->firstOrFail();
        if ($restaurant->user_id != Auth::id()) {
            abort(code: 403);
        }
        $restaurants = Restaurant::where("user_id", Auth::id())->get();

        $orders = Order::with(['products' => function ($query) use ($restaurant) {
            $query->where('restaurant_id', $restaurant->id)->withTrashed();
        }, 'products.restaurant.user'])
            ->whereHas('products.restaurant', function ($subquery) use ($restaurant) {
                $subquery->where('id', $restaurant->id);
            })
            ->whereHas('products.restaurant.user', function ($subquery) {
                $subquery->where('id', auth()->id());
            })
            ->paginate(15);

        return view('admin.orders.index', compact('orders', 'restaurants', 'restaurant'));
    }

    public function getChartData()
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

        return view('admin.orders.statistics', compact('orders'));
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
        $canAccessOrder = $order->products->contains(function ($product){
            return $product->restaurant->user->id === Auth::id();
        });
        if (!$canAccessOrder)
            {
            abort(code: 403);
            }
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
