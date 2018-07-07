<?php

namespace App\Http\Controllers\Admin;

use App\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Cart::where('status', '!=' , 'active')->paginate(10);
        return view('admin.orders.index')->with(compact('orders')); //listado
    }

    public function show(Cart $order)
    {
        $details = $order->details;
        return view('admin.orders.show')->with(compact('order','details')); //listado
    }
}
