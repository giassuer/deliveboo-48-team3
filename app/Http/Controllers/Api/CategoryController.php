<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    // CHIAMATA AXIOS PER CATEGORIES
    public function getCategories(){
        $categories = Category::all();
        // dd($categories);
       return response()->json(['success' => true,
       'results' => $categories
       ]); 
            

        

        // dd($response_array);
    }
}
