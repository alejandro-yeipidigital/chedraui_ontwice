
@extends('layouts.app')

@section('content')

    <section class="container min-h-main flex flex-col justify-center items-center py-12 bg-left-bottom bg-no-repeat" style="background-image: url({{ asset('images/potato.png') }})">

        <h1>RANKING</h1>
        <div class="bg-white text-black w-10/12 max-w-lg rounded-lg border-2 border-yellow py-6 px-16 mt-8">
            
            <div class="w-full flex justify-center items-center">
                @if ($temporality->id - 1 > 0)
                    <a href="{{ route('ranking', $temporality->id - 1) }}" class="text-4xl">
                        <i class="fas fa-caret-left"></i>
                    </a>
                @endif

                <div class="text-3xl mx-8">
                    {{ $temporality->name }}
                </div>

                @if ($temporality->id + 1 <= 4)
                    <a href="{{ route('ranking', $temporality->id + 1) }}" class="text-4xl">
                        <i class="fas fa-caret-right"></i>
                    </a>
                @endif
            </div>

            <div class="w-full mt-4">
                {{-- <div class="" data-tab="1">
                        RANKING
                </div>
                <div class="" data-tab="2">
                        GANADORES
                </div> --}}
                <div class="w-full space-y-2">

                    <div class="flex justify-start items-center border-b border-yellow">
                        <div class="text-yellow text-xl">
                            1
                        </div>
                        <div class="col-9 col-sm-8 col-lg-7 text-Ranking1 p-0 m-0 pl-3 text-left text-lg tracking-wider uppercase">
                            Carla López
                        </div>
                    </div>
                    <div class="flex justify-start items-center border-b border-yellow">
                        <div class="text-yellow text-xl">
                            2
                        </div>
                        <div class="col-9 col-sm-8 col-lg-7 text-Ranking1 p-0 m-0 pl-3 text-left text-lg tracking-wider uppercase">
                            Carla López
                        </div>
                    </div>
                    <div class="flex justify-start items-center border-b border-yellow">
                        <div class="text-yellow text-xl">
                            3
                        </div>
                        <div class="col-9 col-sm-8 col-lg-7 text-Ranking1 p-0 m-0 pl-3 text-left text-lg tracking-wider uppercase">
                            Carla López
                        </div>
                    </div>
                    <div class="flex justify-start items-center border-b border-yellow">
                        <div class="text-yellow text-xl">
                            4
                        </div>
                        <div class="col-9 col-sm-8 col-lg-7 text-Ranking1 p-0 m-0 pl-3 text-left text-lg tracking-wider uppercase">
                            Carla López
                        </div>
                    </div>
                    <div class="flex justify-start items-center border-b border-yellow">
                        <div class="text-yellow text-xl">
                            5
                        </div>
                        <div class="col-9 col-sm-8 col-lg-7 text-Ranking1 p-0 m-0 pl-3 text-left text-lg tracking-wider uppercase">
                            Carla López
                        </div>
                    </div>
                    <div class="flex justify-start items-center border-b border-yellow">
                        <div class="text-yellow text-xl">
                            6
                        </div>
                        <div class="col-9 col-sm-8 col-lg-7 text-Ranking1 p-0 m-0 pl-3 text-left text-lg tracking-wider uppercase">
                            Carla López
                        </div>
                    </div>
                    <div class="flex justify-start items-center border-b border-yellow">
                        <div class="text-yellow text-xl">
                            7
                        </div>
                        <div class="col-9 col-sm-8 col-lg-7 text-Ranking1 p-0 m-0 pl-3 text-left text-lg tracking-wider uppercase">
                            Carla López
                        </div>
                    </div>
                    <div class="flex justify-start items-center border-b border-yellow">
                        <div class="text-yellow text-xl">
                            8
                        </div>
                        <div class="col-9 col-sm-8 col-lg-7 text-Ranking1 p-0 m-0 pl-3 text-left text-lg tracking-wider uppercase">
                            Carla López
                        </div>
                    </div>

                    @foreach ($users as $user)
                        <div class="col-3 col-sm-4 col-lg-5 text-Ranking1 p-0 m-0 text-right font-weight-bold">
                            {{ $rank++ }}
                        </div>
                        <div class="col-9 col-sm-8 col-lg-7 text-Ranking1 p-0 m-0 pl-3 text-left">
                            {{ $user->user->name }} {{ $user->user->middle_name }}
                        </div>
                    @endforeach
                    {{ $users->links() }}
                </div>
                {{-- <div class="contentTab winners_section" style="display: none;">
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
                </div> --}}

        </div> 

    </section>

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