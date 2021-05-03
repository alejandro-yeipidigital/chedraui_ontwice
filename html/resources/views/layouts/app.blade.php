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
        <link href="{{asset('css/app.css')}}" rel="stylesheet">

    </head>
    <body class="bg-black">
        <header class="bg-black h-20 text-yellow">
            <div class="container h-full flex justify-between items-center">
                <a class=" block h-14" href="#">
                    <img class="h-full" src="{{ asset('images/logo_sabritas.png') }}" alt="">    
                </a>  
                <nav>
                    <ul class="flex justify-center items-center space-x-12 text-xl tracking-widest">
                        <li><a href="">MECÁNICA</a></li>
                        <li><a href="">REGÍSTRA TU TICKET</a></li>
                        <li><a href="">PREMIOS</a></li>
                        <li><a href="">RANKING</a></li>
                    </ul>
                </nav>  
                <div class="">
                    <a class="bg-btn w-10 h-10 rounded-full text-black flex justify-center items-center text-xl" href="#">
                        <i class="fas fa-user"></i>
                    </a>
                </div>
            </div>   
        </header>

        <section class="relative">
            <img class="w-full" src="{{ asset('images/banner.jpg') }}" alt="">
            <div class="absolute left-0 top-0 w-1/2 h-full flex justify-center items-center">
                <div class="w-full">
                    <img class="w-10/12 max-w-xl m-auto" src="{{ asset('images/logo_promo.png') }}" alt="Una promo grande como el sol - Sabritas">
                </div>
            </div>
        </section>

        <div class="w-8/12 h-1 mx-auto bg-gradient-to-r from-transparent via-yellow to-transparent"></div>

        <section class="container relative py-36">
            <h2 class="text-yellow text-center text-5xl tracking-widest">MECÁNICA</h2>
            <div class="flex justify-center items-start my-16 space-x-4">
                <div class="flex flex-col justify-center items-center text-center w-full max-w-sm space-y-4">
                    <a class="btn--primary" href="#">
                        1
                    </a>
                    <div class="text-yellow text-3xl tracking-widest">EN LA COMPRA</div>
                    <p>
                        en línea de productos participantes
                    </p>
                    <div class="flex justify-center items-center">
                        <img class="h-8" src="{{ 'images/logo_sabritas.png' }}" alt="Sabritas">
                        <p>en</p>
                        <img class="h-8" src="{{ 'images/logo_chedraui.png' }}" alt="Chedraui">
                    </div>
                </div>
                <div class="flex flex-col justify-center items-center text-center w-full max-w-sm space-y-4">
                    <a class="btn--primary" href="#">
                        2
                    </a>
                    <div class="text-yellow text-3xl tracking-widest">REGÍSTRA</div>
                    <p>
                        Tu ticket en el website para acumular puntos.
                    </p>
                </div>
                <div class="flex flex-col justify-center items-center text-center w-full max-w-sm space-y-4">
                    <a class="btn--primary" href="#">
                        3
                    </a>
                    <div class="text-yellow text-3xl tracking-widest">PARTICIPA PARA GANAR</div>
                    <p>
                        uno de los lentes de la promoción. 
                        <br>
                        Podrán ganar los 10 primeros lugares que acumulen más puntos.
                    </p>
                </div>
            </div>
            <img class="absolute left-0 -bottom-56" src="{{ asset('images/potato.png') }}" alt="Papa Sabritas">
        </section>

        <div class="w-8/12 h-1 mx-auto bg-gradient-to-r from-transparent via-yellow to-transparent"></div>

        <section class="container relative py-36">
            <div class="w-8/12 h-1 mx-auto bg-gradient-to-r from-transparent via-yellow to-transparent"></div>
            <div class="bg-white w-full max-w-4xl mx-auto rounded-lg border-2 border-yellow py-12">
                <h2 class="text-black text-center text-5xl tracking-widest">PREMIOS</h2>
                <img class="mx-auto" src="{{ asset('images/glasses.png') }}" alt="Lentes promoción">
            </div>
            <div class="w-8/12 h-1 mx-auto bg-gradient-to-r from-transparent via-yellow to-transparent"></div>
        </section>

        <section class="container relative py-36">
            <h2 class="text-yellow text-center text-5xl tracking-widest">PRODUCTOS PARTICIPANTES</h2>
        </section>

        {{-- @yield('content') --}}

        <footer>
            <div class="w-8/12 h-1 mx-auto bg-gradient-to-r from-transparent via-yellow to-transparent"></div>
            <div class="container flex justify-between items-center">
                <div class="">
                    <p>COME BIEN</p>
                    <p>BASADO EN LUIS MIGUEL LA SERIE. USO AUTORIZADO POR NETFLIX.</p>
                    <p>©Copyright 2020 PepsiCo, Inc., Todos los Derechos Reservados</p>
                </div>
                <div class="flex justify-center">
                    <a href="">a</a>
                </div>
            </div>
        </footer>

        <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/ee5746e76c.js" crossorigin="anonymous"></script>

        @yield('scripts')
        
    </body>
</html>
