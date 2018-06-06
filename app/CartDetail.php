<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
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
}
