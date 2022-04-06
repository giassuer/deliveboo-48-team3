<?php

namespace App\Http\Controllers\Api;
use App\Http\Resources\DishResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dish;
class DishController extends Controller
{
    public function index(Request $request) {
        $dishes = Dish::all();

        return DishResource::collection($dishes);
    }
}
