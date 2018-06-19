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

        if ($cart->isEmpty()){
            $notification = 'El carrito está vacio. Antes de realizar el pedido debe añadir algún producto al carrito.';
            $success = 'danger';
            return back()->with(compact('success','notification'));
        }
        
        //else
        if (!$cart->inStock()){
            $availableStock = [];
            foreach ($cart->details as $key => $detail) {
                if (!$detail->isEnoughStock()){
                    $availableStock[$key] = $detail->product->stock;
                }
            }
            $success = 'danger';
            $notification = 'No exite stock para alguno de los productos de tu carrito. Revisa tu pedido';
            return back()->with(compact('success','notification', 'availableStock'));
        }
        
        //else
        foreach ($cart->details as $detail) {
            $availableStock = $detail->product->stock;
            $quantity = $detail->quantity;
            $detail->product->stock = $availableStock - $quantity;
            $detail->product->save();
        }
        
        $cart->status = 'Pending';
        $cart->order_date = Carbon::now();
        $cart->save(); //UPDATE

        $admins = User::where('admin', true)->get();
        Mail::to($admins)->send(new NewOrder($client, $cart));

        $notification = 'Tu pedido se ha registrado correctamente. Te contactaremos pronto vía mail';
        return back()->with(compact('success','notification'));

    }

}
