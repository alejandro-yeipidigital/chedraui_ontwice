<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">
        <title>Esta Cuaresma con Saladitas® podrás ganar premios increíbles</title>
        <meta name="description" content="Para participar compra productos Gamesa® participantes, registra tus tickets de compra, participa en nuestro juego y podrás ganar premios increíbles.">

        {{-- Icono Pendiente --}}
        <link rel="shortcut icon" href="{{asset('images/general/Logo_Cookie.png')}}" type="image/x-icon">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <script src="https://kit.fontawesome.com/ae241ef174.js" crossorigin="anonymous"></script>

        {{-- Styles --}}
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
        <link href="{{asset('css/app.css')}}" rel="stylesheet">

    </head>
    <body class="bg-black">
        <header class="bg-black h-20 text-yellow">
            <div class="container h-full flex justify-between items-center">
                <a class=" block h-14" href="{{ url('/') }}">
                    <img class="h-full" src="{{ asset('images/logo_sabritas.png') }}" alt="">    
                </a>  
                <nav>
                    <ul class="flex justify-center items-center space-x-12 text-xl tracking-widest">
                        <li><a href="{{ route('home', '#mecanica') }}">MECÁNICA</a></li>
                        <li><a href="{{ route('home', '#premios') }}">PREMIOS</a></li>
                        <li><a href="{{ route('tickets.index') }}">REGÍSTRA TU TICKET</a></li>
                        <li><a href="{{ route('ranking') }}">RANKING</a></li>
                    </ul>
                </nav>  
                <div class="">
                    <a href="{{ route('users.profile') }}" class="btn__icon--primary text-xl">
                        <i class="fas fa-user"></i>
                    </a>
                </div>
            </div>   
        </header>
        <div class="w-8/12 h-1 mx-auto bg-gradient-to-r from-transparent via-yellow to-transparent"></div>

        @yield('content')

        <div class="w-8/12 h-1 mx-auto bg-gradient-to-r from-transparent via-yellow to-transparent"></div>
        <footer class="py-6">
            <div class="container flex justify-between items-center">
                <div class="font-montserrat text-white">
                    <p class="text-xs">COME BIEN</p>
                    <p class="text-xs">BASADO EN LUIS MIGUEL LA SERIE. USO AUTORIZADO POR NETFLIX.</p>
                    <p class="text-xs">©Copyright 2020 PepsiCo, Inc., Todos los Derechos Reservados</p>
                </div>
                <div class="flex justify-center items-center space-x-2">
                    <a class="btn__icon--primary text-sm" href=""><i class="fab fa-facebook-f"></i></a>
                    <a class="btn__icon--primary text-sm" href=""><i class="fab fa-twitter"></i></a>
                    <a class="btn__icon--primary text-sm" href=""><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </footer>

        <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

        @yield('scripts')
        
    </body>
</html>
