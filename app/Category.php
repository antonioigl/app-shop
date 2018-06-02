<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //validation
    public static $messages = [
        'name.required' => 'Es necesario ingresar un nombre para la categoría',
        'name.min' => 'El nombre la categoría debe tener al menos 3 caracteres',
        'description.max' => 'La descripción corta solo admite hasta 250 caracteres'
    ];

    public static $rules = [
        'name' => 'required|min:3',
        'description' => 'max:250'
    ];

    protected $fillable = ['name', 'description'];

    //$category->products
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
