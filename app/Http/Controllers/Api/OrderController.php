<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Order;
use App\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $restaurant = Restaurant::where('user_id', Auth::user()->id)->first();
        // dd($restaurant);
        // dd($request);
        $data = $request->all();
        $order = new Order();
        $order->name = $data['name'];
        $order->lastname = $data['lastname'];
        $order->address = $data['address'];
        $order->email = $data['email'];
        $order->amount = $data['amount'];
        $order->status = 0;
        // $order->user_id = $restaurant->restaurant_id;
        // dd($order->user_id);
        $order->save();

        foreach ($data['order_details'] as $key => $detail) {
            $order->dishes()->attach($key, ['quantity' => $detail]);
        }

        return response()->json([
            'Message' => 'Order was successfully created',
            'Order_number' => $order->id
        ], 200);
    }

    
}