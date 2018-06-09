@extends('layouts.app')

@section('content')
    <section class="site-section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5 box">
                    <h2 class="mb-5">Cruear cuenta nueva</h2>
                    <form method="post" action="{{ url('/register') }}">

                        {!! csrf_field() !!}

                        <div class="row">
                            <div class="col-md-12 form-group has-feedback{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="email">Nombre</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Nombre">
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
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

                        <div class="row">
                            <div class="col-md-12 form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="email">Contraseña</label>
                                <input type="password" class="form-control" name="password" placeholder="Password">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-5 form-group has-feedback{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="email">Confirmar Contraseña</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <!-- /.col -->
                            <div class="col-md-6 form-group">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">Registrar</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection