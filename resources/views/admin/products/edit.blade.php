@extends('layouts.app')

@section('title', 'Bienvenido a App Shop')
@section('body-class', 'product-page')

@section('content')

    <div class="header header-filter" style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">
    </div>

    <div class="main main-raised">
        <div class="container">

            <div class="section">
                @if(isset($categories))
                    <h2 class="title text-center">Editar producto seleccionado</h2>
                @else
                    <h2 class="title text-center">Editar stock de producto seleccionado</h2>
                    <h3 class="title text-center">{{$product->id}} - {{$product->name}}</h3>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
               
                <form method="post" action="{{url('/admin/products/'.$product->id.'/edit')}}">
                    {{ method_field('PUT') }}
                    {{csrf_field()}}

                    @if(isset($categories))

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Nombre del producto</label>
                                <input type="text" class="form-control" name="name" value="{{old('name', $product->name)}}">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Precio del producto</label>
                                <input type="number" step="0.01" class="form-control" name="price" value="{{old('price', $product->price)}}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Descripción corta del producto</label>
                                <input type="text" class="form-control" name="description" value="{{old('description', $product->description)}}">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Categoría del producto</label>
                                <select class="form-control" name="category_id">General
                                    <option value="0">General</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" {{$category->id == old('category_id', $product->category_id) ? 'selected' : ''}}>
                                            {{$category->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <textarea class="form-control" placeholder="Descripción extensa del producto" rows="5" name="long_description">
                        {{old('long_description', $product->long_description)}}
                    </textarea>

                    @else

                        <p>El stock actual del producto <strong>({{$product->id}} - {{$product->name}})</strong> es de: <strong>{{$product->stock}} unidades</strong></p>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Stock del producto</label>
                                    <input type="text" class="form-control" name="stock" value="{{old('stock', $product->stock)}}">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="name" value="{{ $product->name}}">
                        <input type="hidden" name="price" value="{{ $product->price}}">
                        <input type="hidden" name="description" value="{{ $product->description}}">
                        <input type="hidden" name="category_id" value="{{ $product->category_id}}">
                        <input type="hidden" name="long_description" value="{{ $product->long_description}}">

                    @endif

                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    <a href="{{url('admin/products')}}" class="btn btn-default">Cancelar</a>



                </form>

            </div>

        </div>

    </div>

    @include('includes.footer');


@endsection
