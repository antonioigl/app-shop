<?php

namespace App\Http\Controllers;

use Mail;
use App\Mail\NewOrder;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function update()
    {
        $client = auth()->user();
        $cart = $client->cart;
        $success = 'success';

        if (!$cart->details()->count()){
            $notification = 'El carrito está vacio. Antes de realizar el pedido debe añadir algún producto al carrito. ';
            $success = 'danger';
            return back()->with(compact('success','notification'));
        }

        //else
        $cart->status = 'Pending';
        $cart->order_date = Carbon::now();
        $cart->save(); //UPDATE

        $admins = User::where('admin', true)->get();
        Mail::to($admins)->send(new NewOrder($client, $cart));

        $notification = 'Tu pedido se ha registrado correctamente. Te contactaremos pronto vía mail';
        return back()->with(compact('success','notification'));

    }

}
