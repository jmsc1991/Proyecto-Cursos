<!doctype html>
<html lang="en">
<head>
    <title>Cursos DAW</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,900" rel="stylesheet">

    <link rel="stylesheet" href="{!! asset('template/css/bootstrap.css') !!}">
    <link rel="stylesheet" href="{!! asset('template/css/animate.css') !!}">
    <link rel="stylesheet" href="{!! asset('template/css/owl.carousel.min.css') !!}">

    <link rel="stylesheet" href="{!! asset('template/fonts/ionicons/css/ionicons.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('template/fonts/fontawesome/css/font-awesome.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('template/fonts/flaticon/font/flaticon.css') !!}">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">



    <!-- Theme Style -->
    <link rel="stylesheet" href="{!! asset('template/css/style.css') !!}">
</head>
<body>

<header role="banner">
    <nav class="navbar navbar-expand-md navbar-dark bg-light">
        <div class="container">
            <a class="navbar-brand absolute" href="/">Cursos DAW</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse navbar-light" id="navbarsExample05">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Inicio</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="/cursos">Cursos Online</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categorias</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown05">
                            @foreach($categorias as $categoria)
                                <a class="dropdown-item" href="/categoria/{{ $categoria->id }}">{{ $categoria->name }}</a>
                            @endforeach
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/about">Acerca De</a>
                    </li>
                </ul>
                <ul class="navbar-nav absolute-right">
                    <li class="nav-item">
                        <a href="/login" class="nav-link">Entrar</a>
                    </li>
                    <li class="nav-item">
                        <a href="/register" class="nav-link">Registrarse</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
</header>
<!-- END header -->
<section class="site-hero overlay" data-stellar-background-ratio="0.5" style="background-image: url(template/images/big_image_1.jpg);">
    <div class="container">
        <div class="row align-items-center site-hero-inner justify-content-center">
            <div class="col-md-8 text-center">
                <div class="mb-5">
                    @if(Request::path() == 'login')
                        <h1>Login</h1>
                    @endif
                        @if(Request::path() == 'register')
                            <h1>Registro</h1>
                        @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END section -->

@yield('content')

<footer class="site-footer" style="background-image: url(template/images/big_image_3.jpg);">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-4">
                <h3>Acerca de nosotros</h3>
                <p> Cursos DAW es una web desarrollada por Alvaro y Jose, dedicada a la gestión de Cursos y Videos online. Realizada como proyecto de final de curso de DAW</p>
            </div>
            <div class="col-md-6 ml-auto">
                <div class="row">
                    <div class="col-md-4">
                        <ul class="list-unstyled">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
            </div>
        </div>
    </div>
</footer>

<script src="{!! asset('template/js/jquery-3.2.1.min.js') !!}"></script>
<script src="{!! asset('template/js/jquery-migrate-3.0.0.js') !!}"></script>
<script src="{!! asset('template/js/popper.min.js') !!}"></script>
<script src="{!! asset('template/js/bootstrap.min.js') !!}"></script>
<script src="{!! asset('template/js/owl.carousel.min.js') !!}"></script>
<script src="{!! asset('template/js/jquery.waypoints.min.js') !!}"></script>
<script src="{!! asset('template/js/jquery.stellar.min.js') !!}"></script>


<script src="{!! asset('template/js/main.js') !!}"></script>

<script src="{!! asset('js/app.js') !!}"></script>
</body>
</html>