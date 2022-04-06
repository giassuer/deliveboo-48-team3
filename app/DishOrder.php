<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DishOrder extends Model
{
    public function dish(){
        return $this->belongsTo('App\Dish');
    }

    public function orders(){
        return $this->belongsTo('App\Order');
    }

    protected $table="dish_order";
}
