@extends('layouts.app')

@section('title', 'Bienvenido a App Shop | Dashboard')
@section('body-class', 'product-page')

@section('content')

    <div class="header header-filter" style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">
    </div>

    <div class="main main-raised">
        <div class="container">

            <div class="section">
                <h2 class="title text-center">Dashboard</h2>

                @if (session('notification'))
                    <div class="alert alert-{{ session('success')}}">
                        {{ session('notification') }}
                    </div>
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

                <ul class="nav nav-pills nav-pills-primary" role="tablist">
                    <li class="active">
                        <a href="#dashboard" role="tab" data-toggle="tab">
                            <i class="material-icons">dashboard</i>
                            Carrito de compras
                        </a>
                    </li>

                    <li>
                        <a href="#tasks" role="tab" data-toggle="tab">
                            <i class="material-icons">list</i>
                            Pedidos realizados
                        </a>
                    </li>
                </ul>

                <hr>
                <p>Tu carrito de compras presenta {{auth()->user()->cart->details->count()}} productos</p>

                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Nombre</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th>Opciones</th>
                        </tr>
                        </thead>
                    <tbody>

                @foreach(auth()->user()->cart->details as $detail)

                    <tr>
                        <td class="text-center">
                            <img src="{{$detail->product->featured_image_url}}" height="50">
                        </td>
                        <td>
                            <a href="{{url('/products/'. $detail->product->id)}}"  target="_blank">{{$detail->product->name}}</a>
                        </td>

                        <td>&euro; {{$detail->price_detail}}</td>
                        <td>{{$detail->quantity}}</td>
                        <td>&euro; {{$detail->quantity * $detail->price_detail}}</td>
                        <td>
                            <form method="post" action="{{url('/cart')}}">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}

                                <input type="hidden" name="cart_detail_id" value="{{$detail->id}}">

                                <a href="{{url('/products/'. $detail->product->id)}}" target="_blank" rel="tooltip" title="Ver producto" class="btn btn-info btn-simple btn-xs">
                                    <i class="fa fa-info"></i>
                                </a>

                                <button type="button" rel="tooltip" title="Editar producto" class="btn btn-success btn-simple btn-xs" data-toggle="modal" data-target="#modalEditQuantityProduct{{$detail->id}}">
                                    <i class="fa fa-edit"></i>
                                </button>

                                <button type="submit" rel="tooltip" title="Eliminar" class="btn btn-danger btn-simple btn-xs">
                                    <i class="fa fa-times"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                    </td>

                @endforeach
                        </tbody>
                    </table>

                <p><strong>Importe a pagar:</strong> {{auth()->user()->cart->total}} &euro;</p>

                <div class="text-center">
                    <form method="post" action="{{url('/order')}}">
                        {{csrf_field()}}

                        @if(auth()->user()->cart->details()->count())
                            <button class="btn btn-primary btn-round">
                                <i class="material-icons">done</i> Realizar pedido
                            </button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>


    @foreach(auth()->user()->cart->details as $detail)
        <!-- Modal Core -->
        <div class="modal fade" id="modalEditQuantityProduct{{$detail->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Modificar la cantidad del producto - {{$detail->product->name}}</h4>
                    </div>
                    <form method="post" action="{{url("/cart/{$detail->id}/edit")}}">
                        {{csrf_field()}}
                        <div class="modal-body">
                            <input type="number" name="quantity" value="{{$detail->quantity}}" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-info btn-simple">Aceptar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

@include('includes.footer');

@endsection
