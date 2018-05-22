@extends('layouts.app')

@section('content')
    <section class="site-section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5 box">
                    <h2 class="mb-5">Logueate con tu cuenta</h2>
                    <form method="post" action="{{ url('/login') }}">
                        {!! csrf_field() !!}
                        <div class="row">
                            <div class="col-md-12 form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-12 form-group">
                                <label for="password">Contraseña</label>
                                <input type="password" class="form-control" placeholder="Contraseña" name="password">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="submit" value="Login" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
