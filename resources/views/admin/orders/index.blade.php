@extends('layouts.app')

@section('title', 'Listado de pedidos')
@section('body-class', 'product-page')

@section('content')

    <div class="header header-filter" style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">


    </div>

    <div class="main main-raised">
        <div class="container">

            <div class="section text-center">
                <h2 class="title">Listado de pedidos</h2>

                <div class="team">
                    <div class="row">
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="text-center">Id</th>
                                <th class="text-center">Fecha del pedido</th>
                                <th class="text-center">Fecha de llegada</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Nombre del usuario</th>
                                <th class="text-center">Email del usuario</th>
                                <th class="text-center">Teléfono del usuario</th>
                                <th class="text-center">Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $key => $order)
                                <tr>
                                    <td class="text-center">{{$order->id}}</td>
                                    <td class="text-center">{{$order->order_date}}</td>
                                    <td class="text-center">{{!is_null($order->arrived_date) ? $order->arrived_date : '-'}}</td>
                                    <td class="text-center">{{$order->status}}</td>
                                    <td class="text-center">&euro; {{$order->total}}</td>
                                    <td class="text-center"> {{$order->user->name}}</td>
                                    <td class="text-center">{{$order->user->email}}</td>
                                    <td class="text-center">{{!is_null($order->user->phone) ? $order->user->phone : '-'}}</td>
                                    <td class="text-center">
                                        <a href="{{url('admin/orders/'.$order->id)}}" rel="tooltip" title="Ver detalles del pedido" class="btn btn-info btn-simple btn-xs">
                                            <i class="fa fa-info"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$orders->links()}}

                    </div>
                </div>

            </div>


        </div>

    </div>

    @include('includes.footer');


@endsection
