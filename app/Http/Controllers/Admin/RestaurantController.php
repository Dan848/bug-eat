<?php

namespace App\Http\Controllers\Admin;

use App\Models\Restaurant;
use App\Models\Type;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRestaurantRequest;
use App\Http\Requests\UpdateRestaurantRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *

     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('/');
        }
        $user_id = Auth::id();
        $restaurants = Restaurant::where('user_id', $user_id)->with('types')->get();
        return view('admin.restaurants.index', compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     *

     */
    public function create()
    {
        $types = Type::all();
        return view('admin.restaurants.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRestaurantRequest  $request

     */
    public function store(StoreRestaurantRequest $request)
    {
        $data = $request->validated();
        //Add Slug
        $data["slug"] = Str::slug($request->name, "-");
        //Add User_id
        $data["user_id"] = Auth::id();
        //Store Image
        if($request->hasFile("image")){
            $img_path = Storage::put ("uploads", $request->image);
            $data["image"] = asset("storage/" . $img_path);
        }
        $newRestaurant = Restaurant::create($data);

            //Attach Foreign data from another table
            if ($request->has("types")){
                $newRestaurant->types()->attach($request->types);
            }
        return redirect()->route('admin.restaurants.show', $newRestaurant->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant

     */
    public function show(Restaurant $restaurant)
    {
        return view('admin.restaurants.show', compact('restaurant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant

     */
    public function edit(Restaurant $restaurant)
    {
        $types = Type::all();
        return view('admin.restaurants.edit', compact('restaurant', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRestaurantRequest  $request
     * @param  \App\Models\Restaurant  $restaurant

     */
    public function update(UpdateRestaurantRequest $request, Restaurant $restaurant)
    {
        $data = $request->validated();
        $data["slug"] = Str::slug($request->name, "-");

        if ($request->hasFile("image")){
            if ($restaurant->image) {
                Storage::delete($restaurant->image);
            }
            $img_path = Storage::put("uploads", $request->image);
            $data["image"] = asset("storage/" . $img_path);
        }
        $restaurant->update($data);

            //Attach Foreign data from another table
            if ($request->has("types")){
                $restaurant->types()->sync($request->types);
            }
            else {
                $restaurant->sync([]);
            }
        return redirect()->route("admin.restaurants.show",$restaurant->slug)->with("message", "$restaurant->name è stato modificato con successo");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurant  $restaurant

     */
    public function destroy(Restaurant $restaurant)
    {
        //
    }
}
