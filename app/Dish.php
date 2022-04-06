<?php

namespace App;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $fillable = [
        'name',
        'description',
        'path_img',
        'price',
        'visible',
        'slug',
        'restaurant_id'
    ];

    public function restaurant() {
        return $this->belongsTo('App\Restaurant');
    }
    public function orders() {
        return $this->belongsToMany('App\Order')->withPivot('quantity');

    }

    public function DishOrder(){
        return $this->hasMany('App\Dish');
    }

    protected function getUniqueSlugFromName($name) {
        //creo lo slug dal $name
        $slug = Str::slug($name);
        //creo un'altra variabile per evitare che i numeri si concatenino (slug-1-2-3)
        $slug_base = $slug;

        // Controlliamo se esiste già un dish con questo slug.
        $dish_found = Dish::where('slug', '=', $slug)->first();
        $counter = 1;
        while($dish_found) {
            // Se esiste, aggiungiamo -1 allo slug
            // ricontrollo che non esista lo slug con -1, se esiste provo con -2
            $slug = $slug_base . '-' . $counter;
            $dish_found = Dish::where('slug', '=', $slug)->first();
            $counter++;
        }
        return $slug;
    }
}
