<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{

    //validation
    public static $messages = [
        'quantity.required' => 'Es necesario ingresar la cantidad del producto a añadir al carrito de compras',
        'quantity.numeric' => 'El valor de esta campo debe ser numérico',
        'quantity.min' => 'Para añadir un producto al carrito debe seleccionar al menos una unidad'
    ];

    public static $rules = [
        'quantity' => 'required|numeric|min:1'
    ];

    // CartDetail N    1 Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    //accessor
    public function getPriceDetailAttribute()
    {
        if ($this->price ==  0){
            return $this->product->price;
        }

        return $this->price;
    }

    public function isEnoughStock()
    {
        return $this->quantity <= $this->product->stock;
    }
}
