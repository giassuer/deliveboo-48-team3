<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Category;
class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories_array = config('category');
        foreach($categories_array as $category) {
            $new_category = new Category();
            $new_category->fill($category);
            $new_category->slug = Str::slug($new_category->name);
            $new_category->save();
        };
    }
}
