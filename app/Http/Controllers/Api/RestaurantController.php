<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;
use App\Dish;
use App\Category;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Restaurant::with('dish','category')->get();
        return response()->json($restaurants);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        // $restaurant = Restaurant::find($id);
        $restaurant = Restaurant::where('slug', '=', $slug)->first();
        $restaurant_dishes = Dish::where('restaurant_id', $restaurant->id)->with('restaurant')->get();
        $filtered_dish = [];
        foreach ($restaurant_dishes as $dish) {
            $filtered_dish[] = [
                'id' => $dish->id,
                'name' => $dish->name,
                'path_img' => $dish->path_img,
                'description' => $dish->description,
                'price' => $dish->price,
                'visible' => $dish->visible,
                'slug' => $dish->slug,
                'quantity' => 0
            ];
        }

        // dd($slug);

        $result = [
            'restaurant' => $restaurant,
            'dishes' => $filtered_dish,
        ];

        return response()->json($result);
    }
}