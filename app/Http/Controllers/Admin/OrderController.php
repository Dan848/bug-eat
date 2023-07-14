<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {
        // $orders_nello = Order::join('products', 'orders.id_product', '=', 'products.id_product')
        //     ->join('restaurants', 'restaurants.restaurant_id', '=', 'products.restaurant_id')
        //     ->join('users', 'users.user_id', '=', 'restaurants.user_id')
        //     ->where('users.user_id', auth()->id())
        //     ->get();

        // $user = Auth::user();

        // $orders = Order::whereHas('products.restaurant.user', function ($query) use ($user) {
        //     $query->where('id', $user->id);
        // })->with('products')->get();

        $orders = Order::with('products.restaurant.user')
            ->whereHas('products.restaurant.user', function ($query) {
                $query->where('id', auth()->id());
            })->paginate(15);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
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
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
