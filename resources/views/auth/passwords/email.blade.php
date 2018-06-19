@extends('layouts.app')

@section('body-class', 'signup-page')

@section('content')

    <div class="header header-filter" style="background-image: url('{{asset('img/city.jpg')}}'); background-size: cover; background-position: top center;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card card-signup">
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="header header-primary text-center">
                                <h4>Restablecer contraseña</h4>
                            </div>
                            <p class="text-divider">Ingresa tu dirección de email</p>
                            <div class="content">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                            <i class="material-icons">email</i>
                                        </span>
                                    <input id="email" type="email" placeholder="Correo electrónico" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="footer text-center">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Enviar enlace restablecer contraseña') }}
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('includes.footer');
    </div>

@endsection
