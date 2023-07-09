<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Type;

class RestaurantController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->query());
        if (!empty($request->query('types'))){
            $types_ids = $request->query('types');
            $restaurants = Restaurant::with('types')
            ->whereHas('types', function ($query) use ($types_ids) {
                $query->whereIn('types.id', $types_ids);
            }, '=', count($types_ids))->paginate(12);
        } else {
            $restaurants = Restaurant::with('types')->paginate(12);
        }
        return response()->json([
            'success' => true,
            'results' => $restaurants,
        ]);
    }
    public function show($slug)
    {
        $restaurant = Restaurant::with(['types', 'products' => function ($subquery) {
            $subquery->where('visible', 1);
        }])->where('slug', $slug)->first();

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
