<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function dishes() {
        return $this->belongsToMany('App\Dish')->withPivot('quantity');
    }
    public function DishOrder(){
        return $this->hasMany('App\DishOrder');
    }
    
    public static function checkStatus($status){
        if($status === 0){
            return ('Non Pagato');
        }else{
            return ('Pagato');
        }
    }

}
