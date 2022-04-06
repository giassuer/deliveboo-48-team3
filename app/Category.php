<?php

namespace App;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug'
    ];

    public function restaurant() {
        return $this->belongsToMany('App\Restaurant');
    }

    protected function getUniqueSlugFromName($name) {
        //creo lo slug dal $name
        $slug = Str::slug($name);
        //creo un'altra variabile per evitare che i numeri si concatenino (slug-1-2-3)
        $slug_base = $slug;

        // Controlliamo se esiste già una category con questo slug.
        $category_found = Category::where('slug', '=', $slug)->first();
        $counter = 1;
        while($category_found) {
            // Se esiste, aggiungiamo -1 allo slug
            // ricontrollo che non esista lo slug con -1, se esiste provo con -2
            $slug = $slug_base . '-' . $counter;
            $category_found = Category::where('slug', '=', $slug)->first();
            $counter++;
        }
        return $slug;
    }
}
