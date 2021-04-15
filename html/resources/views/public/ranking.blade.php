@extends('layouts.app')

@section('content')


    <div class="rankingContainer">
        <div class="rankingBanner">
            <div class="rankingSection">

                <div class="row col-12 p-0 m-0 text-center justify-content-center">
                    <div class="generalSectionsTitle">
                        <h1>RANKING</h1>
                    </div>

                    <div class="rankingContain generalSectionsContain">
                        <div class="carouselContainer">
                            <div class="carouselContainerContent ranking">

                                <div class="ranking__temporalities">
                                    @if ($temporality->id - 1 > 0)
                                        <a href="{{ route('ranking', $temporality->id - 1) }}" class="icon-prev">
                                        {{-- <div class="icon-prev" id="prevTemporality"> --}}
                                            <div class="circleArrow">
                                                <i class="fas fa-caret-up leftArrow fa-2x"></i>
                                            </div>
                                        {{-- </div> --}}
                                        </a>
                                    @endif

                                    <ul class="ranking__temporalities-content">
                                        <li class="faseName active">
                                            <h1 class="week">{{ $temporality->name }}</h1>
                                        </li>   
                                    </ul>

                                    @if ($temporality->id + 1 <= 4)
                                        <a href="{{ route('ranking', $temporality->id + 1) }}" class="icon-next">
                                            {{-- <div class="icon-next" id="nextTemporality"> --}}
                                            <div class="circleArrow">
                                                <i class="fas fa-caret-up rightArrow fa-2x"></i>
                                            </div>
                                            {{-- </div> --}}
                                        </a>
                                    @endif
                                </div>

                                <div class="ranking__tabs col-12">
                                    <div class="col-6 col-md-4 col-lg-4 col-xl-3 btn tab_ranking tab_1 active pr-3" data-tab="1">
                                        <a class="p-0 pl-3 pt-1 pb-1 pr-3">
                                            RANKING
                                        </a>
                                    </div>
                                    <div class="col-6 col-md-4 col-lg-4 col-xl-3 btn tab_ranking tab_2" data-tab="2">
                                        <a class="p-0 pl-3 pt-1 pb-1 pr-3">
                                            GANADORES
                                        </a>
                                    </div>
                                </div>
                    
                                <div class="ranking__list">

                                    <div class="contentTab ranking_section active">
                                        @foreach ($users as $user)
                                            <div class="ranking__list-content active">
                                                <li class="row p-0 m-0 col-12 justify-content-between">
                                                    <div class="col-3 col-sm-4 col-lg-5 text-Ranking1 p-0 m-0 text-right font-weight-bold">
                                                        {{ $rank++ }}
                                                    </div>
                                                    <div class="col-9 col-sm-8 col-lg-7 text-Ranking1 p-0 m-0 pl-3 text-left">
                                                        {{ $user->user->name }} {{ $user->user->middle_name }}
                                                    </div>
                                                </li>
                                            </div>
                                        @endforeach
                                        {{ $users->links() }}
                                    </div>
                                    <div class="contentTab winners_section" style="display: none;">
                                        @foreach ($winners as $winner)
                                            <div class="ranking__list-content active">
                                                <li class="row p-0 m-0 col-12 justify-content-between">
                                                    <div class="col-3 col-sm-4 col-lg-5 text-Ranking1 p-0 m-0 text-right font-weight-bold">
                                                        {{ $loop->index + 1 }}
                                                    </div>
                                                    <div class="col-9 col-sm-8 col-lg-7 text-Ranking1 p-0 m-0 pl-3 text-left">
                                                        {{ $winner->user->name }} {{ $winner->user->middle_name }}
                                                    </div>
                                                </li>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                    
                                <p class="ranking__legal"><small>*Ranking con carácter informativo, no representa resultados finales.</small></p>

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

    <script>

        $( document ).ready(function() {

            let totalTemporalities = 1;

            var tabActive = 1;


            $('.tab_ranking').click(function() {
                tabActive = $(this).data('tab');
                console.log(tabActive);
                $('.tab_'+tabActive).addClass('active');
                if (tabActive == 1) {
                    $('.tab_2').removeClass('active');
                } else {
                    $('.tab_1').removeClass('active');
                }

                $('.contentTab').hide();
                if(tabActive == 1){
                    $('.ranking_section').show();
                }else{
                    $('.winners_section').show();
                }
            });
        });

    </script>

@endsection