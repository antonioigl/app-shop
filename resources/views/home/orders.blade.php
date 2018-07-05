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


                <ul class="nav nav-pills nav-pills-primary" role="tablist">
                    <li>
                        <a href="{{url('home/')}}">
                            <i class="material-icons">dashboard</i>
                            Carrito de compras
                        </a>
                    </li>

                    <li class="active">
                        <a href="{{url('carts/')}}" role="tab" data-toggle="tab">
                            <i class="material-icons">list</i>
                            Pedidos realizados
                        </a>
                    </li>
                </ul>

                <hr>
                <p>Has realizado {{auth()->user()->orders()->count()}} pedidos</p>

                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">Fecha</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Importe</th>
                            <th class="text-center">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(auth()->user()->orders() as $order)
                            <tr>
                                <td class="text-center"> {{$order->order_date}} </td>
                                <td class="text-center">{{$order->status}}</td>
                                <td class="text-center">{{$order->total}} &euro;</td>
                                <td class="text-center">
                                    <button type="button" rel="tooltip" title="Ver detalles del pedido" class="btn btn-success btn-simple btn-xs" data-toggle="modal" data-target="#modalShowOrderDetails{{$order->id}}">
                                        <i class="fa fa-info"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    @foreach(auth()->user()->orders() as $ord)
        <!-- Modal Core -->
        <div class="modal fade" id="modalShowOrderDetails{{$ord->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Detalles del pedido con fecha - {{$ord->order_date}}</h4>
                    </div>
                    <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Nombre</th>
                                <th>Precio</th>
                                <th class="text-center">Cantidad</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($ord->details as $detail)
                            <tr>
                                <td class="text-center">
                                    <img src="{{$detail->product->featured_image_url}}" height="50">
                                </td>
                                <td class="text-center">{{$detail->product->name}}</td>
{{--                                <td class="text-center">{{auth()->user()->orders}}</td>--}}

{{--                                <td>&euro; {{$detail->price_detail}}</td>--}}
                                <td> {{$detail->price_detail}}</td>
                                <td class="text-center"> {{$detail->quantity}}</td>
                                <td>&euro; {{$detail->quantity * $detail->price_detail}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                        <p class="text-right"><strong>Total importe:</strong> {{$ord->total}} &euro;</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default text-center" data-dismiss="modal" aria-hidden="true">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


@include('includes.footer');

@endsection
