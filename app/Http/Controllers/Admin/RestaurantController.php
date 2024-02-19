<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRestaurantRequest;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Restaurant::all();
        return view('admin.restaurants.index', compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.restaurants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRestaurantRequest $request)
    {
        $form_data = $request->validated();
        // dd($form_data);
        $restaurant = new Restaurant();
        $restaurant->fill($form_data);
        // dd($restaurant);
        // $restaurant->slug = Str::slug($restaurant->name, '-');
        
        $restaurant->save();

        return redirect()->route('admin.restaurants.show', ['restaurant' => $restaurant->slug]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        return view('admin.restaurants.show', compact('restaurant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $restauramt
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        return view('admin.restaurants.edit', compact('restaurant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        $form_data = $request->all();
        $restaurant->update($form_data);

        return redirect()->route('admin.restaurants.show', ['restaurant' => $restaurant->slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();

        return redirect()->route('admin.restaurants.index')->with('message', "$restaurant->restaurant_name deleted succesfully");
    }
}
