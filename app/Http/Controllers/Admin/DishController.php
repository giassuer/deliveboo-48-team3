<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Dish;
use App\Restaurant;




class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = Auth::user()->id;
        $restaurant = Restaurant::where('user_id',$id)->get();
        // dd($restaurant[$restaurant->id]);
            return view('admin.dishes.create');
        
            // return redirect()->route('admin.restaurants.show')->with('unauthorized', "Non sei autorizzato ad aggiungere piatti per questo ristorante.");
        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validationRules());
        $form_data=$request->all();
        $new_dish = new Dish();
        

        $userRestaurant = Restaurant::where('user_id', Auth::user()->id)->first();
        $new_dish->restaurant_id = $userRestaurant->id;
        // dd($new_dish->restaurant_id);
        $new_dish->fill($form_data);
        // dd($userRestaurant->id);
        
        // SLUG
        $new_dish->slug = Dish::getUniqueSlugFromName($form_data['name']);
        // Faccio l'upload il nuovo file
        if(isset($form_data['image'])) {
            $path_img = Storage::put('dish_images', $form_data['image']);
            $new_dish->path_img = $path_img;
        }

        $new_dish->save();
        

        return redirect()->route('admin.restaurants.show', ['restaurant' => $userRestaurant->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Dish $dish)
    {
        
        if( $dish->restaurant->user_id != Auth::id() ) {

            return redirect()->route('admin.restaurants.index');
        }

        return view('admin.dishes.edit', compact('dish'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $form_data = $request->all();
        $request->validate($this->validationRules());
        $userRestaurant = Restaurant::where('user_id', Auth::user()->id)->first();
        $dish = Dish::findOrFail($id);

        // Aggiorno lo slug soltanto se l'utente in fase di modifica cambia il titolo
        if($form_data['name'] != $dish->name) {
            $form_data['slug'] = Dish::getUniqueSlugFromName($form_data['name']);
        }

        if(isset($form_data['image'])) {
            // Cancello il file vecchio
            if($dish->path_img) {
                Storage::delete($dish->path_img);
            }

            // Faccio l'upload il nuovo file
            $path_img = Storage::put('dish_images', $form_data['image']);

            // Salvo nella colonna cover il path al nuovo file
            $form_data['path_img'] = $path_img;
        }
        
        $dish->update($form_data);

             

        return redirect()->route('admin.restaurants.show', ['restaurant' => $userRestaurant->id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dish = Dish::findOrFail($id);
        $userRestaurant = Restaurant::where('user_id', Auth::user()->id)->first();
        if($dish->path_img) {
            Storage::delete($dish->path_img);
        }
        $dish->delete();

        return redirect()->route('admin.restaurants.show', ['restaurant' => $userRestaurant->id]);
    }

    // VALIDAZIONI PER DISHES
    public function validationRules(){
        return [
            'name' => 'required|max:100',
            'description' => 'required|max:60000',
            'image' => 'image|max:512',
            'price' => 'required|numeric|gt:0',
            'visible' => 'required',
        ];
    }
}
