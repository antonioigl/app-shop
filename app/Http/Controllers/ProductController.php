<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index')->with(compact('products')); //listado
    }

    public function create()
    {
        return view('admin.products.create'); //formulario de registro
    }

    public function store()
    {
        //registrar nuevo producto en la bd
    }
}
