<?php

use Illuminate\Database\Seeder;
use App\Dish;
use Illuminate\Support\Str;
class DishesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dishes_array = config('dishes');
        foreach ($dishes_array as $dish) {
            $new_dish = new Dish();
            $new_dish->fill($dish);
            $new_dish->slug = Str::slug($new_dish->name);
            $new_dish->save();


        }
    }
}
