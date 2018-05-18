<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductImage;
use File;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index($id)
    {
        $product = Product::find($id);
        $images = $product->images()->orderBy('featured', 'desc')->get();
        return view('admin.products.images.index')->with(compact('product','images'));
    }

    public function store(Request $request, $id)
    {
        //guardar la imagen en nuestro proyecto
        $file = $request->file('photo');
        $path = public_path() . '/images/products';
        $fileName = uniqid() . $file->getClientOriginalName();
        $moved = $file->move($path, $fileName);

        //crear un registro en la tabla product_images
        if ($moved){
            $productImage = new ProductImage();
            $productImage->image = $fileName;
//          $productImage->feature = false;
            $productImage->product_id = $id;
            $productImage->save(); //INSERT
        }

        return back();
    }

    public function destroy(Request $request)
    {
        //eliminar el archivo
        $productImage = ProductImage::find($request->image_id);
        if (substr($productImage->image, 0, 4) === "http"){
            $deleted = true;
        }
        else{
             $fullPath = public_path() . '/images/products/' . $productImage->image;
             $deleted = File::delete($fullPath);
        }

        //eliminar el registro de la imagen en la base de datos
        if ($deleted){
            $productImage->delete();
        }

        return back();
    }

    public function select($product_id, $image_id)
    {

        //Ponemos a false todas las imagenes del producto
        ProductImage::where('product_id', $product_id)->update([
            'featured' => false
        ]);

        //Descatacamos la imagen seleccionada
        $productImage = ProductImage::find($image_id);
        $productImage->featured = true;
        $productImage->save();

        return back();
    }
}
