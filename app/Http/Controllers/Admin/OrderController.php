<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Dish;
use App\Restaurant;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
    public function index()
    {
        // restaurant validation
        $restaurant = Restaurant::where('user_id', Auth::user()->id)->first();

        $orders =  Dish::where('restaurant_id', $restaurant->id)->with('orders')->get()->pluck('orders')->first();
        // $orders = $orders->paginate(6);

        return view('admin.orders.index', compact('orders', 'restaurant'));
    }


    public function show($id)
    {
        $restaurant = Restaurant::where('user_id', Auth::user()->id)->first();
        $order = Order::findOrFail($id);
        $dishes = $order->dishes;
    
            foreach ($dishes as $dish) {
                $dishes->quantity = $dish->pivot->quantity;
                // dd($plate->quantity);
            }
        




        return view('admin.orders.show', compact('order', 'restaurant', 'dishes'));
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')->with('alert-type', 'success')->with('alert-msg', "Ordine n° $order->id eliminato con successo");
    }

    public function trash()
    {
        $restaurant = Restaurant::where('user_id', Auth::user()->id)->first();
        $orders = Order::onlyTrashed()->get();
        return view('admin.orders.trash', compact('orders', 'restaurant'));
    }

    public function restore($id)
    {
        $order = Order::withTrashed()->find($id);
        $order->restore();
        return redirect()->route('admin.orders.index')->with('alert-type', 'success')->with('alert-msg', "Ordine n° $order->id ripristinato con successo");
    }
}