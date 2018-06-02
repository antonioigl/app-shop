<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name')->paginate(10);
        return view('admin.categories.index')->with(compact('categories')); //listado
    }

    public function create()
    {
        return view('admin.categories.create'); //formulario de registro
    }

    public function store(Request $request)
    {
        //validation
        $this->validate($request, Category::$rules, Category::$messages);

        //registrar nuevo producto en la bd
        Category::create($request->all()); //mass assignment

        return redirect('/admin/categories');
    }


    public function edit(Category $category)
    {
        return view('admin.categories.edit')->with(compact('category')); //formulario de edición
    }

    public function update(Request $request, Category $category)
    {
        //validation
        $this->validate($request, Category::$rules, Category::$messages);

        //actalizar producto en la bd
        $category->update($request->all()); // UPDATE

        return redirect('/admin/categories');
    }

    public function destroy(Category $category)
    {
        //eliminar producto seleccionado
        $category->delete(); //DELETE

        return back();
    }
}
