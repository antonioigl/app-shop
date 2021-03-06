@extends('layouts.app')

@section('body-class', 'signup-page')

@section('content')

    <div class="header header-filter" style="background-image: url('{{asset('img/city.jpg')}}'); background-size: cover; background-position: top center;">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
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
                        <form class="form" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="header header-primary text-center">
                                <h4>Inicio de sesión</h4>
                            </div>
                            <p class="text-divider">Ingresa tus datos</p>
                            <div class="content">

                                <div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">perm_identity</i>
										</span>
                                    <input id="username" type="text" placeholder="Username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

                                    @if ($errors->has('username'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                    @endif</div>

                                <div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">lock_outline</i>
										</span>
                                    <input id="password" type="password" placeholder="Contraseña" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                 {{--If you want to add a checkbox to this form, uncomment this code--}}

                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        Recordar sesión
                                    </label>
                                </div>
                            </div>
                            <div class="footer text-center">
                                <button type="submit" class="btn btn-simple btn-primary btn-lg">Ingresar</button>
                            </div>

                            <div class="footer text-center">
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('¿Has olvidado tu contraseña?') }}
                                </a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('includes.footer');
    </div>

@endsection
