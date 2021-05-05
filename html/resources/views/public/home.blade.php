@extends('layouts.app')

@section('content')

    <section class="relative">
        <img class="w-full" src="{{ asset('images/banner.jpg') }}" alt="">
        <div class="absolute left-0 top-0 w-1/2 h-full flex justify-center items-center">
            <div class="w-full space-y-8">
                <img class="w-10/12 max-w-xl m-auto" src="{{ asset('images/logo_promo.png') }}" alt="Una promo grande como el sol - Sabritas">
                <div class="flex justify-center items-center">

                    @guest
                        <a class="btn--primary" href="{{ route('login') }}">INICIAR SESIÓN</a>
                        <a class="btn--red" href="{{ route('register') }}">REGÍSTRARTE</a>
                    @else
                        <a class="btn--primary" href="{{ route('users.profile') }}">VER PERFIL</a>
                        <a class="btn--red" href="{{ route('tickets.index') }}">REGÍSTRAR TICKET</a>
                    @endguest

                </div>
            </div>
        </div>
    </section>
    <div class="w-8/12 h-1 mx-auto bg-gradient-to-r from-transparent via-yellow to-transparent"></div>

    <section class="container relative pt-24 pb-36" id="mecanica">
        <h2 class="text-yellow text-center text-5xl tracking-widest">MECÁNICA</h2>
        <div class="flex justify-center items-start my-16 space-x-4">
            <div class="flex flex-col justify-center items-center text-center w-full max-w-sm">
                <a class="btn__icon--primary mb-4" href="#">
                    1
                </a>
                <div class="text-yellow text-3xl tracking-widest">EN LA COMPRA</div>
                <p>
                    en línea de productos participantes
                </p>
                <div class="flex justify-center items-center space-x-4">
                    <img class="h-8" src="{{ 'images/logo_sabritas.png' }}" alt="Sabritas">
                    <p>en</p>
                    <img class="h-8" src="{{ 'images/logo_chedraui.png' }}" alt="Chedraui">
                </div>
            </div>
            <div class="flex flex-col justify-center items-center text-center w-full max-w-sm">
                <a class="btn__icon--primary mb-4" href="#">
                    2
                </a>
                <div class="text-yellow text-3xl tracking-widest">REGÍSTRA</div>
                <p>
                    Tu ticket en el website para acumular puntos.
                </p>
            </div>
            <div class="flex flex-col justify-center items-center text-center w-full max-w-sm">
                <a class="btn__icon--primary mb-4" href="#">
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
        <img class="absolute w-72 -bottom-36" style="left: calc(50% - 9rem)" src="{{ asset('images/potato.png') }}" alt="Papa Sabritas">
    </section>
    <div class="w-8/12 h-1 mx-auto bg-gradient-to-r from-transparent via-yellow to-transparent"></div>

    <section class="container relative py-36 pb-0" id="premios">
        <div class="w-8/12 h-1 mx-auto bg-gradient-to-r from-transparent via-yellow to-transparent"></div>
        <div class="bg-white text-black w-full max-w-4xl mx-auto rounded-lg border-2 border-yellow py-12">
            <h2 class="text-center text-5xl tracking-widest">PREMIOS</h2>
            <img class="mx-auto max-w-md" src="{{ asset('images/glasses.png') }}" alt="Lentes promoción">
            <p class="text-center text-sm mt-4">La imágenes son ilustrativas y pueden no coincidir con el premio final</p>
        </div>
        <div class="w-8/12 h-1 mx-auto bg-gradient-to-r from-transparent via-yellow to-transparent"></div>
    </section>

    <section class="container relative py-24">
        <h2 class="text-yellow text-center text-5xl tracking-widest">PRODUCTOS PARTICIPANTES</h2>

        <div class="my-8" id="products">

            <div class="bg-white mx-6 rounded-lg border-2 border-yellow w-60 h-60">
                <img class="w-full h-full object-contain p-6" src="{{ asset('images/products/chetetos_torciditos.png') }}" alt="">
            </div>

            <div class="bg-white mx-6 rounded-lg border-2 border-yellow w-60 h-60">
                <img class="w-full h-full object-contain p-6" src="{{ asset('images/products/chicharron_cerdo.png') }}" alt="">
            </div>

            <div class="bg-white mx-6 rounded-lg border-2 border-yellow w-60 h-60">
                <img class="w-full h-full object-contain p-6" src="{{ asset('images/products/currumais_flamas.png') }}" alt="">
            </div>

            <div class="bg-white mx-6 rounded-lg border-2 border-yellow w-60 h-60">
                <img class="w-full h-full object-contain p-6" src="{{ asset('images/products/chetetos_torciditos.png') }}" alt="">
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
                infinite: true,
                dots: true
              }
            },
            {
              breakpoint: 767,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
          ],
          prevArrow: `<button type="button" class="slick-prev btn__icon--red"><i class="fas fa-caret-left"></i></button>`,
          nextArrow: `<button type="button" class="slick-next btn__icon--red"><i class="fas fa-caret-right"></i></button>`,
        });
    </script>

@endsection