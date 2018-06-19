<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public function details()
    {
        return $this->hasMany(CartDetail::class);
    }

    public function getTotalAttribute()
    {
        $total = 0;
        foreach ($this->details as $detail) {
            $total += $detail->quantity * $detail->price_detail;
        }
        return $total;
    }

    public function isEmpty()
    {
        if ($this->details()->count()){
            return false;
        }
        //else
        return true;
    }

    public function inStock()
    {
        foreach ($this->details as $detail) {
            if(!$detail->isEnoughStock()){
                return false;
            }
        }
        return true;
    }


}
