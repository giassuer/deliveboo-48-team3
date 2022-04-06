<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;
use App\Dish;
use App\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\User;


class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $user = Auth::user();

        $id = Auth::user()->id;

        $restaurants = Restaurant::where('user_id',$id)->get();
           
        // dd($restaurant);

        return view ('admin.restaurants.index',compact('restaurants', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        $id = Auth::user()->id;
        $restaurants = Restaurant::where('user_id',$id)->get();
        $categories = Category::all();

        if($restaurants->isEmpty()){
            return view ('admin.restaurants.create', compact('categories'));
        }else{
            return redirect()->route('admin.restaurants.index');
        }
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
        $form_data = $request->all();
        $new_restaurant = new Restaurant();
        $new_restaurant->fill($form_data);
        $new_restaurant->user_id = Auth::id();
        $new_restaurant->slug = Restaurant::getUniqueSlugFromName($form_data['restaurant_name']);
        if(isset($form_data['image'])) {
            $path_img = Storage::put('restaurant_images', $form_data['image']);
            $new_restaurant->path_img = $path_img;
        }
        $new_restaurant->save();

        if(isset($form_data['categories'])) {
            $new_restaurant->category()->sync($form_data['categories']);
        }

        return redirect()->route('admin.restaurants.index', ['restaurant' => $new_restaurant->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant, Request $request)
    {
        $user_id = $restaurant->user->id;
        if ($user_id !== Auth::user()->id) {
            return redirect()->route('admin.restaurants.index');
        }
        $user_id = $request->user()->id;
        $restaurant = User::find($user_id)->restaurant;
        $dishes = Dish::where('restaurant_id',$user_id)->get();
        

        return view('admin.restaurants.show',compact('restaurant','dishes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant, Request $request)
    {

        $user_id = $restaurant->user->id;
        
        if ($user_id !== Auth::user()->id) {
            return redirect()->route('admin.home');
        }
        /* $restaurant = Restaurant::findOrFail($id); */
        $user_id = $request->user()->id;
        $restaurant = User::find($user_id)->restaurant;
        $categories = Category::all();

        return view('admin.restaurants.edit', compact('restaurant', 'categories'));
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

        $restaurant = Restaurant::findOrFail($id);

        // Aggiorno lo slug soltanto se l'utente in fase di modifica cambia il titolo
        if($form_data['restaurant_name'] != $restaurant->restaurant_name) {
            $form_data['slug'] = Restaurant::getUniqueSlugFromName($form_data['restaurant_name']);
        }
        
        if(isset($form_data['image'])) {
            // Cancello il file vecchio
            if($restaurant->path_img) {
                Storage::delete($restaurant->path_img);
            }

            // Faccio l'upload il nuovo file
            $path_img = Storage::put('restaurant_images', $form_data['image']);

            // Salvo nella colonna cover il path al nuovo file
            $form_data['path_img'] = $path_img;
        }
        
        $restaurant->update($form_data);

        if(isset($form_data['categories'])) {
            $restaurant->category()->sync($form_data['categories']);
        } else {
            // Se non esiste la chiave tags in form_data
            // significa che l'utente a rimosso il check da tutti i tag
            // quindi se questo post aveva dei tag collegati li rimuovo
            $restaurant->category()->sync([]);
        }
        

        return redirect()->route('admin.restaurants.show', ['restaurant' => $restaurant->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->category()->sync([]);
        if($restaurant->path_img) {
            Storage::delete($restaurant->path_img);
        }
        $restaurant->delete();

        return redirect()->route('admin.restaurants.index');
    }

    public function validationRules() {
        return [
            'restaurant_name' => 'required|max:100',
            'address' => 'required|max:255',
            'vat' => 'required|max:11',
            'phone' => 'required|max:11',
            'image' => 'image|max:512'
        ];
    }
    
}
