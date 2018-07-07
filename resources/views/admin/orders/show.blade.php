@extends('layouts.app')

@section('title', 'Detalles del pedido')
@section('body-class', 'product-page')

@section('content')

    <div class="header header-filter" style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">
    </div>

    <div class="main main-raised">
        <div class="container">

            <div class="section">
                <h2 class="title text-center">Detalles del pedido {{$order->id}}</h2>

                <div class="panel panel-default">
                    <div class="panel-heading">Datos del cliente</div>
                    <div class="panel-body">
                        <ul>
                            <li>Nombre: {{$order->user->name}}</li>
                            <li>Email: {{$order->user->email}}</li>
                            <li>Teléfono: {{$order->user->phone}}</li>
                            <li>Dirección: {{$order->user->address}}</li>
                        </ul>
                    </div>
                </div>
                <hr>
                <p>Este pedido presenta {{$details->count()}} productos</p>

                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Nombre</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                        </tr>
                        </thead>
                    <tbody>
                        @foreach($details as $detail)
                            <tr>
                                <td class="text-center">
                                    <img src="{{$detail->product->featured_image_url}}" height="50">
                                </td>
                                <td class="text-center">
                                    <a href="{{url('/products/'. $detail->product->id)}}"  target="_blank">{{$detail->product->name}}</a>
                                </td>
                                <td>&euro; {{$detail->price_detail}}</td>
                                <td> {{$detail->quantity}}</td>
                                <td>&euro; {{$detail->quantity * $detail->price_detail}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                <p><strong>Importe total:</strong> {{$order->total}} &euro;</p>
            </div>
        </div>
    </div>

@include('includes.footer');

@endsection
