@extends('layouts.app')

@section('content')

    <div class="topBanner" id="topBanner">
        <div class="backTopImage">

            <div class="Logo_Main1">
                <img src="{{asset('images/home/top_banner/Logo_MainTop.png')}}" alt="Logo_MainTop">
            </div>

            <div class="Logo_Main2">
                <img src="{{asset('images/home/top_banner/Logo_MainBottom_SM.png')}}" alt="Logo_MainBottom_SM">
                <img src="{{asset('images/home/top_banner/Logo_MainBottom_LG.png')}}" alt="Logo_MainBottom_LG">
            </div>

            <div class="buttonsContainer">
                <div class="buttonsGroup">
                    <div class="buttonTopBanner">
                        @guest
                            <a 
                                href="#" 
                                data-toggle="modal" 
                                data-target="#staticBackdrop"
                                class="loginBtn"
                            >
                                <span class="p-0 m-0" id="btnLoginMain">INICIAR SESIÓN</span>
                            </a>
                        @else
                            <a
                                href="{{ route('logout') }}"
                                class="loginBtn"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form-nav').submit();"
                            >
                                <span class="p-0 m-0">CERRAR SESIÓN</span>
                            </a>
                            <form id="logout-form-nav" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @endguest
                    </div>
                    <br><br>
                    <div class="buttonTopBanner">
                        @guest
                            <a 
                                href="{{route('register')}}"
                                class="registerBtn"
                            >
                                <span class="p-0 m-0">CREAR CUENTA</span>
                            </a>
                        @else
                            <a 
                                href="{{route('tickets.index')}}"
                                class="registerBtn"
                            >
                                <span class="p-0 m-0">REGISTRA TU TICKET</span>
                            </a>
                        @endguest
                    </div>
                </div>
            </div>

            <div class="hellmansLogoMain">
                <img src="{{asset('images/footer/Logo_Hellmanns.png')}}"
                    class="hellmansLogoMainImg"
                    alt="Logo_Hellmanns"
                >
            </div>

            <div class="modal fade"  id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content modalForm">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                            <div class="generalSectionsTitle pt-1 pb-1">
                                <img src="{{asset('images/home/top_banner/Logo_IniciarSesion.png')}}" alt="Logo_IniciarSesion">
                            </div>

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="col-12">
                                    <label 
                                        for="email" 
                                        class="generalFormLabel"
                                    >
                                        {{ __('E-mail:') }}
                                    </label>

        
                                    <div class="col-12 p-0">
                                        <input 
                                            id="email" 
                                            type="email" 
                                            class="generalFormInput @error('email') is-invalid @enderror" 
                                            name="email" 
                                            value="{{ old('email') }}" 
                                            required 
                                            autocomplete="off" 
                                        >
        
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="col-12">
                                    <label 
                                        for="password" 
                                        class="generalFormLabel"
                                    >
                                        {{ __('Contraseña') }}
                                    </label>
        
                                    <div class="col-12 p-0">
                                        <input 
                                            id="password" 
                                            type="password" 
                                            class="generalFormInput @error('password') is-invalid @enderror" 
                                            name="password" 
                                            required 
                                            autocomplete="off"
                                        >
        
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
              
                                @if (Route::has('password.request'))
                                    <div class="col-12 text-right">
                                        <a class="text-blueSaladitas text-decoration-none" href="{{ route('password.request') }}">
                                            <small>
                                                {{ __('¿Olvidaste tu contraseña?') }}
                                            </small>
                                        </a>
                                    </div>
                                @endif

                                <div class="actionButton pb-2">
                                    <button type="submit">
                                        {{ __('INICIAR')}}
                                    </button>    
                                </div>

                                <div class="col-12 text-center text-blueSaladitas">
                                    <small class="font-weight-bold">o registrese con</small>
                                </div>
    
                                <div class="buttonFBConnect pt-2">
                                    <a href="{{ route('social.auth', 'facebook') }}">
                                        FACEBOOK
                                    </a>
                                </div>

                                <div class="col-12 text-center text-blueSaladitas pt-3 pb-3">
                                    <small class="font-weight-bold">¿Aún no estas registrado?</small>
                                </div>

                                <div class="buttonCreateAccount">
                                    <a href="{{route('register')}}">
                                        CREAR CUENTA
                                    </a>    
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="middleBanner" id="middleBanner">
        <div class="backMiddleImage">
            <div class="mecanicaSection">
                <div>
                    <div class="generalSectionsTitle">
                        <img src="{{asset('images/home/middle_banner/Logo_Mecanica.png')}}" alt="Logo_Mecanica">
                    </div>
    
                    <div class="mecanicaSteps generalSectionsContain">
                        <div class="mecanicaStepsContain">
                            
                            <div class="step1">
                                <div class="steps">
                                    <div class="romboNumbers bg-colorRedCompraShadow">
                                        <span>1</span>
                                    </div>
                                    <div class="text-colorRedCompra pt-4">
                                        <h1>
                                            COMPRA
                                        </h1>
                                    </div>
                                    <div class="romboArray">
                                        <div class="romboThree bg-colorRedCompra"></div>
                                        <div class="romboThree bg-colorRedCompra"></div>
                                        <div class="romboThree bg-colorRedCompra"></div>
                                    </div>
                                    <div class="stepDescription text-colorRedCompra pt-4">
                                        <h5>
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti a molestias veniam itaque cum distinctio natus hic laboriosam sint amet dolores consequuntur, nostrum ipsum qui facilis ullam maiores repellat vel!
                                        </h5>
                                    </div>
                                </div>    
                            </div>
    
                            <div class="step2">
                                <div class="steps">
                                    <div class="romboNumbers bg-colorGreenRegisterShadow">
                                        <span>2</span>
                                    </div>
                                    <div class="text-colorGreenRegister pt-4">
                                        <h1>
                                            REGISTRA
                                        </h1>
                                    </div>
                                    <div class="romboArray">
                                        <div class="romboThree bg-colorGreenRegister"></div>
                                        <div class="romboThree bg-colorGreenRegister"></div>
                                        <div class="romboThree bg-colorGreenRegister"></div>
                                    </div>
                                    <div class="stepDescription text-colorGreenRegister pt-4">
                                        <h5>
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti a molestias veniam itaque cum distinctio natus hic laboriosam sint amet dolores consequuntur, nostrum ipsum qui facilis ullam maiores repellat vel!
                                        </h5>
                                    </div>
                                </div>
                            </div>
    
                            <div class="step3">
                                <div class="steps">
                                    <div class="romboNumbers bg-colorBlueRedimeShadow">
                                        <span>3</span>
                                    </div>
                                    <div class="text-colorBlueRedime pt-4">
                                        <h1>
                                            REDIME
                                        </h1>
                                    </div>
                                    <div class="romboArray">
                                        <div class="romboThree bg-colorBlueRedime"></div>
                                        <div class="romboThree bg-colorBlueRedime"></div>
                                        <div class="romboThree bg-colorBlueRedime"></div>
                                    </div>
                                    <div class="stepDescription text-colorBlueRedime pt-4">
                                        <h5>
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti a molestias veniam itaque cum distinctio natus hic laboriosam sint amet dolores consequuntur, nostrum ipsum qui facilis ullam maiores repellat vel!
                                        </h5>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="bottomBanner" id="bottomBanner">
        <div class="backBottomImage">
            <div class="premiosSection">

                <div class="col-12 p-0 m-0">
                    <div class="generalSectionsTitle">
                        <img src="{{asset('images/home/bottom_banner/Logo_Premios.png')}}" alt="Logo_Premios">
                    </div>
    
                    <div class="premiosContain generalSectionsContain">

                        {{-- Carousel LG --}}

                        <div class="leftArrowCarouselLG">
                            <button href="#rewardsCarouselLG" data-slide="prev">
                                <i class="fas fa-caret-up leftArrow fa-3x"></i>
                            </button>
                        </div>

                        <div class="carousel slide text-center" id="rewardsCarouselLG" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item carouselItemsLG active">
                                    <div class="d-flex col-12 align-items-center justify-content-around p-0">
                                        <div class="carouselItemsLGDiv col-4">
                                            <div>
                                                <img class="pt-4 pb-3" src="{{asset('images/home/bottom_banner/Amazon_Card.png')}}" alt="reward1">
                                            </div>
                                            <div class="pb-3">
                                                <span class="rewardName">
                                                    Tarjeta digital Amazon $1,000.00
                                                </span>
                                            </div>
                                        </div>
                                        <div class="carouselItemsLGDiv col-4">
                                            <div>
                                                <img class="pt-4 pb-3" src="{{asset('images/home/bottom_banner/Amazon_Card.png')}}" alt="reward2">
                                            </div>
                                            <div class="pb-3">
                                                <span class="rewardName">
                                                    Tarjeta digital Amazon $500.00
                                                </span>
                                            </div>    
                                        </div>
                                        <div class="carouselItemsLGDiv col-4">
                                            <div>
                                                <img class="pt-4 pb-3" src="{{asset('images/home/bottom_banner/Amazon_Card.png')}}" alt="reward3">
                                            </div>
                                            <div class="pb-3">
                                                <span class="rewardName">
                                                    Tarjeta digital Amazon $300.00
                                                </span>
                                            </div>    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="rightArrowCarouselLG">
                            <button href="#rewardsCarouselLG" data-slide="next">
                                <i class="fas fa-caret-up rightArrow fa-3x"></i>
                            </button>
                        </div>

                        {{-- Carousel SM --}}

                        <div class="leftArrowCarouselSM">
                            <button href="#rewardsCarouselSmall" data-slide="prev">
                                <i class="fas fa-caret-up leftArrow fa-3x"></i>
                            </button>
                        </div>

                        <div class="carousel slide text-center" id="rewardsCarouselSmall" data-ride="carousel">
                            <div class="carousel-inner w-100 text-center">
                                <div class="carousel-item carouselItemsSM active">
                                    <div>
                                        <img class="pt-4 pb-3" src="{{asset('images/home/bottom_banner/Amazon_Card.png')}}" alt="reward1">
                                    </div>
                                    <div class="pb-3">
                                        <span class="rewardName">
                                            Tarjeta digital Amazon $1,000.00
                                        </span>
                                    </div>
                                </div>
                                <div class="carousel-item carouselItemsSM">
                                    <div>
                                        <img class="pt-4 pb-3" src="{{asset('images/home/bottom_banner/Amazon_Card.png')}}" alt="reward2">
                                    </div>
                                    <div class="pb-3">
                                        <span class="rewardName">
                                            Tarjeta digital Amazon $500.00
                                        </span>
                                    </div>
                                </div>
                                <div class="carousel-item carouselItemsSM">
                                    <div>
                                        <img class="pt-4 pb-3" src="{{asset('images/home/bottom_banner/Amazon_Card.png')}}" alt="reward3">
                                    </div>
                                    <div class="pb-3">
                                        <span class="rewardName">
                                            Tarjeta digital Amazon $300.00
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="rightArrowCarouselSM">
                            <button href="#rewardsCarouselSmall" data-slide="next">
                                <i class="fas fa-caret-up rightArrow fa-3x"></i>
                            </button>
                        </div>

    
                    </div>    
                </div>

            </div>
        </div>
    </div>

@endsection


@section('scripts')

    @if($errors->any())
        <script>
                $('#staticBackdrop').modal('show');
        </script>    
    @endif

@endsection