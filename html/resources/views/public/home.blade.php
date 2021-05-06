@extends('layouts.app')

@section('content')

    <section class="sm:hidden pb-4">
        <img class="w-full" src="{{ asset('images/banner_mobile.png') }}" alt="">
        <img class="w-10/12 max-w-xl m-auto" src="{{ asset('images/logo_promo.png') }}" alt="Una promo grande como el sol - Sabritas">
        <div class="flex flex-wrap justify-center items-center py-2">
            @guest
                <a class="btn--primary my-2" href="{{ route('login') }}">INICIAR SESIÓN</a>
                <a class="btn--red my-2" href="{{ route('register') }}">REGÍSTRARTE</a>
            @else
                <a class="btn--primary my-2" href="{{ route('users.profile') }}">VER PERFIL</a>
                <a class="btn--red my-2" href="{{ route('tickets.index') }}">REGÍSTRAR TICKET</a>
            @endguest
        </div>
    </section>

    <section class="hidden sm:block relative">
        <img class="w-full" src="{{ asset('images/banner.jpg') }}" alt="">
        <div class="absolute left-0 top-0 w-1/2 h-full flex justify-center items-center">
            <div class="w-full space-y-8 px-4">
                <img class="w-10/12 max-w-xl m-auto" src="{{ asset('images/logo_promo.png') }}" alt="Una promo grande como el sol - Sabritas">
                <div class="flex flex-wrap justify-center items-center">
                    @guest
                        <a class="btn--primary my-2" href="{{ route('login') }}">INICIAR SESIÓN</a>
                        <a class="btn--red my-2" href="{{ route('register') }}">REGÍSTRARTE</a>
                    @else
                        <a class="btn--primary my-2" href="{{ route('users.profile') }}">VER PERFIL</a>
                        <a class="btn--red my-2" href="{{ route('tickets.index') }}">REGÍSTRAR TICKET</a>
                    @endguest
                </div>
            </div>
        </div>
    </section>
    <div class="line-gradient"></div>



    <section class="container relative pt-24 pb-36" id="mecanica">
        <h2 class="text-yellow text-center text-5xl tracking-widest">MECÁNICA</h2>
        <div class="flex flex-col items-center sm:flex-row justify-center sm:items-start my-8 space-y-8 sm:space-y-0 space-x-4">
            <div class="flex flex-col justify-center items-center text-center w-full max-w-sm">
                <a class="btn__icon--primary mb-4" href="#">
                    1
                </a>
                <div class="text-yellow text-2xl sm:text-3xl tracking-widest">EN LA COMPRA</div>
                <p class="text-lg tracking-wider">
                    en línea de productos participantes
                </p>
                <div class="flex justify-center items-center space-x-4">
                    <img class="h-8" src="{{ 'images/logo_sabritas.png' }}" alt="Sabritas">
                    <p class="text-lg tracking-widest">
                    <img class="h-8" src="{{ 'images/logo_chedraui.png' }}" alt="Chedraui">
                </div>
            </div>
            <div class="flex flex-col justify-center items-center text-center w-full max-w-sm">
                <a class="btn__icon--primary mb-4" href="#">
                    2
                </a>
                <div class="text-yellow text-2xl sm:text-3xl tracking-widest">REGÍSTRA</div>
                <p class="text-lg tracking-wider">
                    Tu ticket en el website para acumular puntos.
                </p>
            </div>
            <div class="flex flex-col justify-center items-center text-center w-full max-w-sm">
                <a class="btn__icon--primary mb-4" href="#">
                    3
                </a>
                <div class="text-yellow text-2xl sm:text-3xl tracking-widest">PARTICIPA PARA GANAR</div>
                <p class="text-lg tracking-wider">
                    uno de los lentes de la promoción. 
                    <br>
                    Podrán ganar los 10 primeros lugares que acumulen más puntos.
                </p>
            </div>
        </div>
        <img class="absolute w-72 -bottom-36" style="left: calc(50% - 9rem)" src="{{ asset('images/potato.png') }}" alt="Papa Sabritas">
    </section>
    <div class="line-gradient"></div>

    <section class="container relative py-36 pb-0" id="premios">
        <div class="line-gradient"></div>
        <div class="bg-white text-black w-full max-w-4xl mx-auto rounded-lg border-2 border-yellow py-12">
            <h2 class="text-center text-5xl tracking-widest">PREMIOS</h2>
            <img class="w-full mx-auto max-w-md" src="{{ asset('images/glasses.png') }}" alt="Lentes promoción">
            <p class="text-center mt-4">La imágenes son ilustrativas y pueden no coincidir con el premio final</p>
        </div>
        <div class="line-gradient"></div>
    </section>

    <section class="container relative py-24">
        <h2 class="text-yellow text-center text-5xl tracking-widest">PRODUCTOS PARTICIPANTES</h2>

        <div class="my-8" id="products">

            <div class="bg-white mx-6 rounded-lg border-2 border-yellow w-60 h-60">
                <img class="w-full h-full object-contain p-2" src="{{ asset('images/products/CHEETOS_TORCIDITOS_370G-1000.png') }}" alt="">
            </div>

            <div class="bg-white mx-6 rounded-lg border-2 border-yellow w-60 h-60">
                <img class="w-full h-full object-contain p-2" src="{{ asset('images/products/CHICHARRON_CERDO_115G_1000.png') }}" alt="">
            </div>

            <div class="bg-white mx-6 rounded-lg border-2 border-yellow w-60 h-60">
                <img class="w-full h-full object-contain p-2" src="{{ asset('images/products/CHURRUMAIS_FLAMA_COMPARTE_HBSF-1000.png') }}" alt="">
            </div>

            <div class="bg-white mx-6 rounded-lg border-2 border-yellow w-60 h-60">
                <img class="w-full h-full object-contain p-2" src="{{ asset('images/products/CRUJITOS_120G_COMPARTE_HBSF_1000.png') }}" alt="">
            </div>

            <div class="bg-white mx-6 rounded-lg border-2 border-yellow w-60 h-60">
                <img class="w-full h-full object-contain p-2" src="{{ asset('images/products/DORITOS NACHO_FIESTA_370G_HB-1000.png') }}" alt="">
            </div>

            <div class="bg-white mx-6 rounded-lg border-2 border-yellow w-60 h-60">
                <img class="w-full h-full object-contain p-2" src="{{ asset('images/products/FRITOS SAL Y LIMON_FAMILIAR_HB_265G-1000.png') }}" alt="">
            </div>

            <div class="bg-white mx-6 rounded-lg border-2 border-yellow w-60 h-60">
                <img class="w-full h-full object-contain p-2" src="{{ asset('images/products/KARATE_JAPONES_154G-1000.png') }}" alt="">
            </div>

            <div class="bg-white mx-6 rounded-lg border-2 border-yellow w-60 h-60">
                <img class="w-full h-full object-contain p-2" src="{{ asset('images/products/RANCHERITOS_240G_FAMILIAR-1000.png') }}" alt="">
            </div>

            <div class="bg-white mx-6 rounded-lg border-2 border-yellow w-60 h-60">
                <img class="w-full h-full object-contain p-2" src="{{ asset('images/products/RENDER_185g_FH-1000.png') }}" alt="">
            </div>

            <div class="bg-white mx-6 rounded-lg border-2 border-yellow w-60 h-60">
                <img class="w-full h-full object-contain p-2" src="{{ asset('images/products/RUFFLES_QUESO_120G_HBSF_1000.png') }}" alt="">
            </div>

            <div class="bg-white mx-6 rounded-lg border-2 border-yellow w-60 h-60">
                <img class="w-full h-full object-contain p-2" src="{{ asset('images/products/SABRITAS_SAL_340G_SF_MEGA_1000.png') }}" alt="">
            </div>

            <div class="bg-white mx-6 rounded-lg border-2 border-yellow w-60 h-60">
                <img class="w-full h-full object-contain p-2" src="{{ asset('images/products/SABRITONES_GD_160G-1000.png') }}" alt="">
            </div>

            <div class="bg-white mx-6 rounded-lg border-2 border-yellow w-60 h-60">
                <img class="w-full h-full object-contain p-2" src="{{ asset('images/products/SUNBITES_PALOMITA_37G_SAL_HB-1000.png') }}" alt="">
            </div>

            <div class="bg-white mx-6 rounded-lg border-2 border-yellow w-60 h-60">
                <img class="w-full h-full object-contain p-2" src="{{ asset('images/products/SUNBITES_PLATANITO_28G_DULCE_HB-1000.png') }}" alt="">
            </div>

            <div class="bg-white mx-6 rounded-lg border-2 border-yellow w-60 h-60">
                <img class="w-full h-full object-contain p-2" src="{{ asset('images/products/TOSTITOS_SV_FAMILIAR_240_HB-1000.png') }}" alt="">
            </div>

        </div>

    </section>

@endsection


@section('scripts')

    <script>
        $('#products').slick({
          dots: false,
          infinite: true,
          speed: 300,
          slidesToShow: 3,
          slidesToScroll: 1,
          responsive: [
            {
              breakpoint: 1023,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
              }
            },
            {
              breakpoint: 767,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
          ],
          prevArrow: `<button type="button" class="slick-prev btn__icon--red"><i class="fas fa-caret-left"></i></button>`,
          nextArrow: `<button type="button" class="slick-next btn__icon--red"><i class="fas fa-caret-right"></i></button>`,
        });
    </script>

@endsection