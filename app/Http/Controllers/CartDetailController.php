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
        //validation
        $this->validate($request, CartDetail::$rules, CartDetail::$messages);

        $cartDetail = new CartDetail();

        //check before if product is in cart
        $cart = auth()->user()->cart;
        $product_id = $request->product_id;

        if ($cart->details->contains('product_id', $product_id)){
            $success = 'warning';
            $notification  = 'Este producto ya ha sido cargado anteriormente en tu carrito de compras';
            return back()->with(compact('success', 'notification'));
        }

        //else
        $cartDetail->cart_id = $cart->id;
        $cartDetail->product_id = $product_id;
        $cartDetail->quantity = $request->quantity;

        $product = Product::find($product_id);
        $cartDetail->price = $product->price;

        $cartDetail->save();

        $success = 'success';
        $notification  = 'El producto se ha cargado a tu carrito de compras exitosamente';
        return back()->with(compact('success', 'notification'));
    }

    public function update(Request $request, CartDetail $cartDetail)
    {
        //validation
        $this->validate($request, CartDetail::$rules, CartDetail::$messages);
        
        $cartDetail->quantity = $request->input('quantity');
        $cartDetail->save();

        $notification = 'La cantidad del producto se ha modificado correctamente';
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
