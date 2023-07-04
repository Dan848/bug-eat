<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Str;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *

     */
    public function index()
    {
        $user_id = Auth::id();
        $restaurants = Restaurant::where('user_id', $user_id)->with('products')->first();
        $restaurant_id = $restaurants->id;
        $products = Product::where('restaurant_id', $restaurant_id)->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *

     */
    public function create()
    {
        $user_id = Auth::id();
        $restaurants = Restaurant::where('user_id', $user_id)->get();
        $products = Product::all();
        return view('admin.products.create', compact('products', 'restaurants'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     */
    public function store(StoreProductRequest $request)
    {
        $user_id = Auth::id();
        // $restaurant = Restaurant::where('user_id', $user_id)->get();
        // $restaurant_id = $restaurant->id;

        $data = $request->validated();
        //Add Slug
        $data["slug"] = Str::slug($request->name, "-");
        //Add User_id
        // $data["restaurant_id"] = $request->$restaurant->id;
        //Store Image
        if ($request->hasFile("image")) {
            $img_path = Storage::put("uploads", $request->image);
            $data["image"] = asset("storage/" . $img_path);
        }
        $newProduct = Product::create($data);
        $newProduct->slug = Str::slug($newProduct->name, '-') . "-" . $newProduct->id;
        $newProduct->save();

        return redirect()->route('admin.products.index', $newProduct->slug);
    }

    /**
     * Display the specified resource.
     *

     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *

     */
    public function edit(Product $product)
    {
        $user_id = Auth::id();
        $restaurants = Restaurant::where('user_id', $user_id)->get();
        return view('admin.products.edit', compact('product', 'restaurants'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();
        $data["slug"] = Str::slug($request->name, "-") . "-" . $product->id;

        if ($request->hasFile("image")) {
            if ($product->image) {
                Storage::delete($product->image);
            }
            $img_path = Storage::put("uploads", $request->image);
            $data["image"] = asset("storage/" . $img_path);
        }
        $product->update($data);


        return redirect()->route("admin.products.show", $product->slug)->with("message", "$product->name è stato modificato con successo");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     */
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::delete($product->image);
        }
        $product->delete();
        return redirect()->route("admin.products.index")->with("message", "$product->name è stato eliminato con successo");
    }
}
