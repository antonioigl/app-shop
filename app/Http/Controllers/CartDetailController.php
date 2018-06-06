<?php

namespace App\Http\Controllers;

use App\CartDetail;
use App\Product;
use Illuminate\Http\Request;

class CartDetailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $cartDetail = new CartDetail();
        $cartDetail->cart_id = auth()->user()->cart->id;
        $cartDetail->product_id = $request->product_id;
        $cartDetail->quantity = $request->quantity;

        $product = Product::find($request->product_id);
        $cartDetail->price = $product->price;

        $cartDetail->save();

        $notification  = 'El producto se ha cargado a tu carrito de compras exitosamente';
        return back()->with(compact('notification'));
    }

    public function destroy(Request $request)
    {
        $cartDetail = CartDetail::find($request->cart_detail_id);

        //borra el detalle del carrito del usuario logueado (para evitar peticiones de borrado de usuarios maliciosos)
        if ($cartDetail->cart_id == auth()->user()->cart->id) {
            $cartDetail->delete();
        }
        $notification = 'El producto se ha eliminado del carrito de compras correctamente';
        return back()->with(compact('notification'));
    }
}
