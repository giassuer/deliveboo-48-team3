<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Restaurant;
class RestaurantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $restaurants_array = config('restaurants');
        foreach ($restaurants_array as $restaurant) {
            $new_restaurant = new Restaurant();
            $new_restaurant->fill($restaurant);
            $new_restaurant->slug = Str::slug($new_restaurant->restaurant_name);
            $new_restaurant->save();
        }
    }
}
