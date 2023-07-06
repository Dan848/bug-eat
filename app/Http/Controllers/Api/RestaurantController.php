<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::with('types')->paginate(12);
        return response()->json([
            'success' => true,
            'results' => $restaurants
        ]);
    }
    public function show($slug)
    {
        $restaurant = Restaurant::with('types', 'products')->where('slug', $slug)->first();

        if ($restaurant) {
            return response()->json([
                'success' => true,
                'results' => $restaurant
            ]);
        } else {
            return response()->json([
                'success' => false,
                'results' => 'Il ristorante non è stato trovato'
            ]);
        }
    }
}
