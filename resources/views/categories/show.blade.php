@extends('layouts.app')

@section('title', 'Bienvenido a App Shop | Dashboard')
@section('body-class', 'profile-page')

@section('styles')
    <style>
        .team{
            padding-bottom: 50px;
        }
        .tem .row .col-md-4 {
            margin-bottom: 5em;
        }

        .team .row {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display:         flex;
            flex-wrap: wrap;
        }
        .team .row > [class*='col-'] {
            display: flex;
            flex-direction: column;
        }
    </style>
@endsection

@section('content')

    <div class="header header-filter" style="background-image: url('/img/examples/city.jpg');"></div>

    <div class="main main-raised">
        <div class="profile-content">
            <div class="container">
                <div class="row">
                    <div class="profile">
                        <div class="avatar">
                            <img src="{{$category->featured_image_url}}" class="img-circle img-responsive img-raised" alt="Imagen representativa de la categoría {{$category->name}}">
                        </div>

                        <div class="name">
                            <h3 class="title">{{$category->name}}</h3>
                        </div>

                        @if (session('notification'))
                            <div class="alert alert-success">
                                {{ session('notification') }}
                            </div>
                        @endif

                    </div>
                </div>
                <div class="description text-center">
                    <p>
                        {{$category->description}}
                    </p>
                </div>


                <div class="team text-center">
                    <div class="row">
                        @foreach($products as $product)
                            <div class="col-md-4">
                                <div class="team-player">
                                    <img src="{{$product->featured_image_url}}" alt="Thumbnail Image" class="img-raised img-circle">
                                    <h4 class="title">
                                        <a href="{{url('products/'.$product->id)}}">{{$product->name}} </a>
                                    </h4>
                                    <p class="description"> {{$product->description}}</p>
                                    <h4> {{$product->price}} &euro;</h4>
                                    {{--<a href="#pablo" class="btn btn-simple btn-just-icon"><i class="fa fa-twitter"></i></a>--}}
                                    {{--<a href="#pablo" class="btn btn-simple btn-just-icon"><i class="fa fa-instagram"></i></a>--}}
                                    {{--<a href="#pablo" class="btn btn-simple btn-just-icon btn-default"><i class="fa fa-facebook-square"></i></a>--}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center">
                        {{$products->links()}}
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal Core -->
    <div class="modal fade" id="modalAddToCart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Seleccione la cantidad que desea agregar</h4>
                </div>
                <form method="post" action="{{url('/cart')}}">
                    {{csrf_field()}}
                    <input type="hidden" name="product_id" value="{{$product->id}}">
                    <div class="modal-body">
                        <input type="number" name="quantity" value="1" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-info btn-simple">Añadir al carrito</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@include('includes.footer');

@endsection
