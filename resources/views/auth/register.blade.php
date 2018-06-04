@extends('layouts.app')

@section('body-class', 'signup-page')
@section('content')

    <div class="header header-filter" style="background-image: url('{{asset('img/city.jpg')}}'); background-size: cover; background-position: top center;">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                    <div class="card card-signup">

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form class="form" method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="header header-primary text-center">
                                <h4>Registro</h4>
                            </div>
                            <p class="text-divider">Completa tus datos</p>
                            <div class="content">

                                <div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">face</i>
										</span>
                                    <input type="text" class="form-control" placeholder="Nombre" name="name" value="{{ old('name') }}" required autofocus>
                                </div>

                                <div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">perm_identity</i>
										</span>
                                    <input type="text" class="form-control" placeholder="Username" name="username" value="{{ old('username') }}" required autofocus>
                                </div>

                                <div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">email</i>
										</span>
                                    <input id="email" type="email" placeholder="Correo electrónico" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" autofocus>
                                </div>

                                <div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">phone</i>
										</span>
                                    <input id="phone" type="phone" placeholder="Teléfono" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required autofocus>
                                </div>

                                <div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">place</i>
										</span>
                                    <input id="address" type="text" placeholder="Dirección" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}" required autofocus>
                                </div>

                                <div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">lock_outline</i>
										</span>
                                    <input type="password" placeholder="Contraseña" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                </div>

                                <div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">lock_outline</i>
										</span>
                                    <input type="password" placeholder="Confirmar contraseña..." class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password_confirmation" required>
                                </div>


                            </div>
                            <div class="footer text-center">
                                <button type="submit" class="btn btn-simple btn-primary btn-lg">Confirmar registro</button>
                            </div>
                            {{--<a class="btn btn-link" href="{{ route('password.request') }}">--}}
                            {{--{{ __('Forgot Your Password?') }}--}}
                            {{--</a>--}}
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('includes.footer');
    </div>


@endsection
