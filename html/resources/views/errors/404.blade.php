@extends('layouts.app')

@section('content')

    <section class="container min-h-main flex flex-col justify-center items-center py-12 bg-left-bottom bg-no-repeat" style="background-image: url({{ asset('images/potato.png') }})">

        <h1>ERROR 404</h1>
        <a class="btn--red" href="{{ route('home') }}">IR AL INICIO</a>

    </section>
   
                        
@endsection