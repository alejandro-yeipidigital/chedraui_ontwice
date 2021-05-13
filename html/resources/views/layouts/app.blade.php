<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Una Promo Grande como el Sol – Luis Miguel La Serie</title>
        <meta name="description" content="Una promo para que formes parte de la segunda temporada de la serie. Si ingresas conocerás la mecánica y los premios que Sabritas y Chedraui tienen para ti.">

        <!-- og tags Facebook -->
        <meta property="fb:app_id" content="373636493516659" />
        <meta property="og:title" content="Una Promo Grande como el Sol – Luis Miguel La Serie">
        <meta property="og:description" content="Una promo para que formes parte de la segunda temporada de la serie. Si ingresas conocerás la mecánica y los premios que Sabritas y Chedraui tienen para ti.">
        <meta property="og:type" content="website">
        <meta property="og:url" content="https://sabritas.com.mx/promocion">
        <meta property="og:image" content="{{ url('/') }}/images/share_fb.jpg">
        <meta property="og:site_name" content="sabritas.com.mx">
        
        <!-- Twitter Cards -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@Papas_Sabritas">
        <meta name="twitter:title" content="Una Promo Grande como el Sol – Luis Miguel La Serie">
        <meta name="twitter:description" content="Una promo para que formes parte de la segunda temporada de la serie. Si ingresas conocerás la mecánica y los premios que Sabritas y Chedraui tienen para ti.">
        <meta name="twitter:creator" content="@Papas_Sabritas">
        <meta name="twitter:image:src" content="{{ url('/') }}/images/share_fb.jpg">
        <meta name="twitter:domain" content="sabritas.com.mx">
        <link rel="canonical" href="https://sabritas.com.mx/promocion">

        <meta name="author" content="Sabritas">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="shortcut icon" href="{{ asset('images/favicon.ico')  }}">


        <script src="https://kit.fontawesome.com/ae241ef174.js" crossorigin="anonymous"></script>

        {{-- Styles --}}
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
        <link href="{{asset('css/app.css')}}" rel="stylesheet">

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-54378716-19"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-54378716-19');
        </script>

        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-N5JGJWC');</script>
        <!-- End Google Tag Manager -->

    </head>
    <body class="bg-black">
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N5JGJWC"
            height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
            <!-- End Google Tag Manager (noscript) -->
            
        <header class="bg-black h-20 text-yellow">
            <div class="container h-full flex justify-between items-center">
                <a class="block h-12 md:h-14" href="{{ url('/') }}">
                    <img class="h-full" src="{{ asset('images/logo_sabritas.png') }}" alt="">    
                </a>  
                <nav class="nav" id="menu">
                    <div class="md:hidden absolute top-4 right-4 text-white text-4xl" id="btnMenuClose">
                        <i class="far fa-times"></i>
                    </div>
                    <img class="md:hidden w-10/12 max-w-xs mb-2" src="{{ asset('images/logo_promo.png') }}" alt="Una promo grande como el sol - Sabritas">
                    <div class="md:hidden line-gradient"></div>
                    <ul class="nav-ul">
                        <li><a class="link_section" href="{{ route('home', '#mecanica') }}">MECÁNICA</a></li>
                        <li><a class="link_section" href="{{ route('home', '#premios') }}">PREMIOS</a></li>
                        @guest
                            <li><a href="{{ route('login') }}">INICIAR SESIÓN</a></li>
                            <li><a href="{{ route('register') }}">REGISTRO</a></li>
                        @else
                            <li><a href="{{ route('tickets.index') }}">REGÍSTRA TU TICKET</a></li>
                            <li><a href="{{ route('ranking') }}">RANKING</a></li>
                        @endguest

                        @auth
                            <li>
                                <a 
                                    href="{{ route('logout') }}"
                                    class="p-0 m-0"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form-desktop').submit();"
                                >
                                    CERRAR SESIÓN
                                </a>
                                <form id="logout-form-desktop" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @endauth
                    </ul>
                </nav>  
                <div class="flex justify-end items-center space-x-3">
                    <a href="{{ route('users.profile') }}" class="btn__icon--primary text-xl">
                        <i class="fas fa-user"></i>
                    </a>
                    <div class="md:hidden text-yellow text-3xl" id="btnMenu">
                        <i class="far fa-bars block"></i>
                    </div>
                </div>
            </div>   
        </header>
        <div class="line-gradient"></div>

        @yield('content')

        <div class="line-gradient"></div>
        <footer class="h-auto py-4 sm:py-0 md:h-24 flex justify-center items-center">
            <div class="container flex flex-col sm:flex-row justify-between items-center">
                <div class="font-montserrat text-white text-xs text-center sm:text-left order-2 sm:order-none">
                    COME BIEN
                    <br>
                    BASADO EN LUIS MIGUEL LA SERIE. USO AUTORIZADO POR NETFLIX.
                    <br>
                    ©Copyright 2020 PepsiCo, Inc., Todos los Derechos Reservados
                    <br>
                    <div class="space-x-2 mt-2">
                        <a class="underline" href="{{ route('terms') }}">Términos y condiciones</a>
                        <a class="underline" href="{{ route('privacy') }}">Aviso de privacidad</a>
                    </div>
                </div>
                <div class="flex justify-center items-center space-x-2 order-1 sm:order-none mb-4 sm:mb-0">
                    <a class="btn__icon--primary text-sm" href="https://www.facebook.com/JoyApp.PepsiCo" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn__icon--primary text-sm" href="https://twitter.com/JoyApp_PepsiCo" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a class="btn__icon--primary text-sm" href="https://www.youtube.com/channel/UCxIhWXZ2NdRRS8q_oc0OtuQ" target="_blank"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </footer>

        <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        <script src="{{ asset('js/app.js') }}"></script>

        @yield('scripts')

        <script>
            $( "#birthdayRegisterInput" ).datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: '-117:+0',
                maxDate: "-18Y",
                dateFormat: 'yy-mm-dd',
                closeText: 'Cerrar',
                prevText: '<Ant',
                nextText: 'Sig>',
                currentText: 'Hoy',
                monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
                dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
                weekHeader: 'Sm',
            });
        </script>
        
    </body>
</html>
