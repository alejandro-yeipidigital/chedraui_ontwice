@extends('layouts.app')

@section('content')

    <div class="rankingContainer">
        <div class="rankingBanner">
            <div class="rankingSection">

                <div class="row col-12 p-0 m-0 text-center justify-content-center">
                    <div class="generalSectionsTitle">
                        <h1>INSTRUCCIONES</h1>
                    </div>

                    <div class="rankingContain generalSectionsContain">
                        <div class="carouselContainer">
                            <div class="carouselContainerContent ranking">

                                <ul class="col-12 pt-3">
                                    <li class="row p-0 m-0 col-12 justify-content-center align-items-center">
                                        <div class="col-12 text-Ranking2 p-0 m-0 text-center instructionsText pt-lg-5">
                                            <span class="text-colorRedCompra">1. Lorem ipsum, dolor sit amet consectetur adipisicing elit.</span>
                                            <br><br>
                                            <span class="text-colorGreenRegister">2. Lorem, ipsum dolor sit amet consectetur adipisicing elit.</span>
                                            <br><br>
                                            <span class="text-colorBlueRedime">3. Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span>
                                            <br><br>
                                            <strong class="text-blueSaladitas">¡Ahora estás listo para empezar!</strong>
                                        </div>
                                    </li>
                                </ul>
                                <div class="col-12 text-center">
                                    <div class="actionButtonDark pt-3">
                                        <a href="{{ route('game.play') }}">INICIAR</a>
                                    </div>
                                </div>
                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="generalLogoCookie">
                    <img src="{{asset('images/general/Logo_Cookie.png')}}" alt="Logo_Cookie">
                </div>

            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        @if ( session('status.freeLife') )
            Swal.fire({
                html: "¡Gracias por registrarte! <br> Saladitas® te regala una vida extra.",
                showConfirmButton: true,
                confirmButtonText:'Aceptar',
            })
        @endif
    </script>
@endsection
