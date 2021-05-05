
@extends('layouts.app')

@section('content')

    <section class="container min-h-main flex flex-col justify-center items-center py-12 bg-left-bottom bg-no-repeat" style="background-image: url({{ asset('images/potato.png') }})">

        <h1>RANKING</h1>
        <div class="bg-white text-black w-10/12 max-w-lg rounded-lg border-2 border-yellow py-6 px-16 mt-8">

            <div class="w-full mt-4">

                @if ($users->count())
                    <div class="w-full space-y-2">
                        @foreach ($users as $user)
                            <div class="flex justify-start items-center border-b border-yellow">
                                <div class="text-yellow text-xl">
                                    {{ $rank++ }}
                                </div>
                                <div class="col-9 col-sm-8 col-lg-7 text-Ranking1 p-0 m-0 pl-3 text-left text-lg tracking-wider uppercase">
                                    {{ $user->user->name }} {{ $user->user->middle_name }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{ $users->links() }}

                @else

                    <div class="text-2xl text-center">No hay resultados.</div>
                        
                @endif

            </div>
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