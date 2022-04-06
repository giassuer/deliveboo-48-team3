<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Restaurant extends Model
{
    protected $fillable = [
        'restaurant_name',
        'address',
        'vat',
        'phone',
        'path_img',
        'slug',
        'user_id'
    ];
    public function user() {
        return $this->belongsTo('App\User');
    }
    public function category() {
        return $this->belongsToMany('App\Category');
    }
    public function dish() {
        return $this->hasMany('App\Dish');
    }

    protected function getUniqueSlugFromName($restaurant_name) {
        //creo lo slug dal $restaurant_name
        $slug = Str::slug($restaurant_name);
        //creo un'altra variabile per evitare che i numeri si concatenino (slug-1-2-3)
        $slug_base = $slug;

        // Controlliamo se esiste già un restaurant con questo slug.
        $restaurant_found = Restaurant::where('slug', '=', $slug)->first();
        $counter = 1;
        while($restaurant_found) {
            // Se esiste, aggiungiamo -1 allo slug
            // ricontrollo che non esista lo slug con -1, se esiste provo con -2
            $slug = $slug_base . '-' . $counter;
            $restaurant_found = Restaurant::where('slug', '=', $slug)->first();
            $counter++;
        }
        return $slug;
    }
}
