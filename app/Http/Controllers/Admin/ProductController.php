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
use \Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index($slug)
    {

        $restaurant = Restaurant::where('slug', $slug)->firstOrFail();
        if ($restaurant->user_id != Auth::id()) {
            abort(code: 403);
        }
        $restaurants = Restaurant::where("user_id", Auth::id())->get();
        $products = Product::where('restaurant_id', $restaurant->id)->paginate(10);
        return view('admin.products.index', compact('products', 'restaurant', 'restaurants'));
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
        $data = $request->validated();
        //Add Slug
        $data["slug"] = Str::slug($request->name, "-");
        //Store Image
        if ($request->hasFile("image")) {
            $img_path = Storage::put("uploads", $request->image);
            $data["image"] = asset("storage/" . $img_path);
        }
        $newProduct = Product::create($data);
        $newProduct->slug = Str::slug($newProduct->name, '-') . "-" . $newProduct->id;
        $newProduct->save();

        return redirect()->route('admin.products.show', $newProduct->slug);
    }

    /**
     * Display the specified resource.
     *

     */
    public function show(Product $product)
    {
        if ($product->restaurant->user_id != Auth::id()) {
            abort(code: 403);
        }
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *

     */
    public function edit(Product $product)
    {
        if ($product->restaurant->user_id != Auth::id()) {
            abort(code: 403);
        }
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
        if ($product->restaurant->user_id != Auth::id()) {
            abort(code: 403);
        }

        if ($product->image) {
            Storage::delete($product->image);
        }
        $product->delete();
        return redirect()->route("admin.menu.index", $product->restaurant)->with("message", "$product->name è stato eliminato con successo");
    }
}
