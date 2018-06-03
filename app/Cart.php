<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public function details()
    {
        return $this->hasMany(CartDetail::class);
    }

    public function getTotalAttibute()
    {
        $total = 0;
        foreach ($this->details as $detail) {
            $total += $detail->quantity * $detail->product->price;
        }
        return $total;
    }
}
