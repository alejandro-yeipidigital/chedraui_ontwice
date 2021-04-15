<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Esta Cuaresma con Saladitas® podrás ganar premios increíbles</title>
        <meta name="description" content="Para participar compra productos Gamesa® participantes, registra tus tickets de compra, participa en nuestro juego y podrás ganar premios increíbles.">

        {{-- Icono Pendiente --}}
        <link rel="shortcut icon" href="{{asset('images/general/Logo_Cookie.png')}}" type="image/x-icon">

        {{-- Styles --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link href="{{asset('css/app.css')}}" rel="stylesheet">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- JS --}}
        <script src="{{asset('js/jquery-3.5.1.min.js')}}"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/ee5746e76c.js" crossorigin="anonymous"></script>

        {{-- Analytics UA  PENDIENTE--}}


        @yield('css')
    </head>
    <body>
        <header>
            <nav class="containerHeader">
                
                <div class="containerLogo">
                    <div id="a_home">
                        <img src="{{asset('images/general/headerLogo1.png')}}" alt="headerLogo1">
                    </div>
                </div>
                <div class="containerSections">
                    <ul>
                        <li>
                            <h1 id="a_mecanica">MECÁNICA</h1>
                        </li>
                        <li>
                            <h1 id="a_premios">PREMIOS</h1>
                        </li>
                        <li>
                            @guest
                                <a href="{{ route('register') }}"><h1>CREAR CUENTA</h1></a>
                            @else
                                <a href="{{ route('tickets.index') }}"><h1>REGISTRA TU TICKET</h1></a>
                            @endguest
                        </li>
                        <li>
                            <a href="{{ route('ranking') }}"><h1>RANKING</h1></a>
                        </li>
                        @auth
                            <li>
                                <a 
                                    href="{{ route('logout') }}"
                                    class="p-0 m-0"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form-desktop').submit();"
                                >
                                    <h1>CERRAR SESIÓN</h1>
                                </a>
                                <form id="logout-form-desktop" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @endauth
                    </ul>
                </div>
                <div class="containerLogin">
                    @guest
                        <div class="shape">
                            <div class="circleProfile">
                                <i class="fas fa-user fa-2x"></i>
                            </div>
                        </div>
                    @else
                        <div class="shape">
                            <a href={{ route('users.profile') }}>
                                @if ( Session::has('userAvatar') && Session::get('userAvatar') != null)
                                    <div class="circleProfile">
                                        <img src={{Session::get('userAvatar')}} alt="avatar">
                                    </div>
                                @else
                                    <div class="circleProfile">
                                        <i class="fas fa-user fa-2x"></i>
                                    </div>
                                @endif
                            </a>
                        </div>
                    @endguest
                </div>
                <div class="containerMenu">
                    <i class="fas fa-bars Icon_Menu text-white fa-2x" id="Icon_Open"></i>
                    <i class="fas fa-times Icon_Menu text-white fa-2x" id="Icon_Close"></i>
                </div>

            </nav>

            <div class="navMenu">
                @auth
                    <div class="linkMenu">
                        <a 
                            href="{{ route('logout') }}"
                            class="p-0 m-0"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form-mobile').submit();"
                        >
                            <h1>CERRAR SESIÓN</h1>
                        </a>
                        <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                    <div class="linkMenu">
                        <a 
                            class="p-0 m-0" 
                            href="{{ route('users.profile') }}"
                        >
                            <h1>MI PERFIL</h1>
                        </a>
                    </div>
                @else
                    <div class="linkMenu">
                        <h1 id="a_login_sm">INICIAR SESIÓN</h1>
                    </div>
                @endauth
                <div class="linkMenu">
                    <h1 id="a_mecanica_sm">MECÁNICA</h1>
                </div>
                <div class="linkMenu">
                    <h1 id="a_premios_sm">PREMIOS</h1>
                </div>
                <div class="linkMenu">
                    @guest
                        <a class="p-0 m-0" href="{{ route('register') }}"><h1>CREAR CUENTA</h1></a>
                    @else
                        <a class="p-0 m-0" href="{{ route('tickets.index') }}"><h1>REGISTRA TU TICKET</h1></a>
                    @endguest
                </div>
                <div class="linkMenu">
                    <a class="p-0 m-0" href="{{ route('ranking') }}"><h1>RANKING</h1></a>
                </div>
            </div>
            
        </header>
        

        @yield('content')


        <footer>
            <div class="containerFooter">
                <div class="footerLogos">
                    <div class="logosBrands">
                        <a href="https://mx.recepedia.com/hellmanns/promise/" target="_blank">
                            <img class="Logo_Hellmans" src="{{asset('images/footer/Logo_HellmannsW.png')}}" alt="Logo_HellmannsW">
                        </a>
                    </div>
                    <div class="logosBrands">
                        <a href="https://tuny.mx/" target="_blank">
                            <img class="Logo_Tuny" src="{{asset('images/footer/Logo_Tuny.png')}}" alt="Logo_Tuny">
                        </a>
                    </div>
                </div>
                <div class="footerCopyright">
                    <div>
                        <h6 class="text-white">COME BIEN</h6>
                        <div class="row col-12 p-0 m-0 align-items-center justify-content-around">
                            <div><a class="text-white" href={{ route('privacy') }} target="_blank"><small><u>Aviso de Privacidad</u></small></a></div>
                            <div><a class="text-white" href={{ route('terms') }} target="_blank"><small><u>Términos y condiciones</u></small></a></div>
                        </div>
                        <h6 class="text-blueSaladitas"><small>©Copyright 2020 PepsiCo, Inc., Todos los Derechos Reservados</small></h6>
                    </div>
                </div>
                <div class="footerSocial">
                    <div class="socialIcon justify-content-center">
                        <a href="https://www.facebook.com/SaladitasMx/" target="_blank">
                            <div class="roundedShape">
                                <i class="fab fa-facebook-f"></i>
                            </div>
                        </a>
                    </div>
                    <div class="socialIcon justify-content-center">
                        <a href="https://www.youtube.com/channel/UCIiA7pCzZiQtYndv9GnlRJA" target="_blank">
                            <div class="roundedShape">
                                <i class="fab fa-instagram"></i>
                            </div>
                        </a>
                    </div>

                </div>

            </div>
        </footer>

        <script>
            $(document).ready(function () {

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

                $(".Icon_Menu").click( function(){
                    if ( $('.navMenu').css('display') === 'none' ) {
                        $('.navMenu').show('slow');            
                        $('#Icon_Open').hide('slow');
                        $('#Icon_Close').show('slow');
                    } else {
                        $('.navMenu').hide('slow');
                        $('#Icon_Close').hide('slow');
                        $('#Icon_Open').show('slow');
                    }
                });

                function scrolling(position , url) {
                    if(document.getElementById( position )){
                        $('html, body').animate({
                            scrollTop: $('#'+position).offset().top - 100
                        }, 500);
                    } else {
                        window.location.href = url ;
                    }
                }

                $('#a_home').click(function(){
                    scrolling( 'topBanner' , '/' );
                });

                $('.circleProfile').click(function(){
                    scrolling( 'topBanner' , '/?login' );
                    $('#btnLoginMain').click();
                });

                $('#a_login_sm').click(function(){
                    scrolling( 'topBanner' , '/?login'  );
                    $('#btnLoginMain').click();
                    $(".Icon_Menu").click();
                });

                $('#a_mecanica').click(function(){
                    scrolling( 'middleBanner' , '/?mecanica'  );
                });

                $('#a_mecanica_sm').click(function(){
                    scrolling( 'middleBanner' , '/?mecanica'  );
                    $(".Icon_Menu").click();
                });

                $('#a_premios').click(function(){
                    scrolling( 'bottomBanner' , '/?premios'  );
                });

                $('#a_premios_sm').click(function(){
                    scrolling( 'bottomBanner' , '/?premios'  );
                    $(".Icon_Menu").click();
                });

                if(window.location.href.split('?').pop() == 'mecanica') {
                    $('html, body').animate({
                            scrollTop: $('#middleBanner').offset().top - 100
                        }, 500);
                }

                if(window.location.href.split('?').pop() == 'premios') {
                    $('html, body').animate({
                            scrollTop: $('#bottomBanner').offset().top - 100
                        }, 500);
                }

                if(window.location.href.split('?').pop() == 'login') {
                    $('#btnLoginMain').click();
                }
            });
        </script>



        @yield('scripts')


        
    </body>
</html>
