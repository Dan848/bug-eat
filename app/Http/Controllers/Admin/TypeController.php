<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;


class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *

     */
    public function index()
    {

        $types = Type::all();
        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *

     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTypeRequest  $request

     */
    public function store(StoreTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type  $type

     */
    public function show(Type $type)
    {
        $user_id = Auth::id();
        $restaurants = Restaurant::where('user_id', $user_id)->types()->where('type_id', $type->id);
        return view('admin.types.show', compact('type', 'restaurants'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Type  $type

     */
    public function edit(Type $type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTypeRequest  $request
     * @param  \App\Models\Type  $type

     */
    public function update(UpdateTypeRequest $request, Type $type)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type  $type

     */
    public function destroy(Type $type)
    {
        //
    }
}
