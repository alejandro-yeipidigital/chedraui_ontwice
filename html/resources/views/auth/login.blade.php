@extends('layouts.app')

@section('content')

    <section class="container min-h-main flex flex-col justify-center items-center py-12 bg-left-bottom bg-no-repeat" style="background-image: url({{ asset('images/potato.png') }})">

        <h1>INICIAR SESIÓN</h1>

        <form class="my-8" method="POST" action="{{ route('login') }}">
                @csrf

                <div class="w-full max-w-md mx-auto space-y-4">

                    <div class="w-full">
                        <label for="email" class="text-yellow block tracking-widest">EMAIL:</label>
                        <input 
                            id="email" 
                            type="email" 
                            class="w-full text-black tracking-widest px-2 h-8 @error('email') is-invalid @enderror" 
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
                    <div class="w-full">
                        <label for="password" class="text-yellow block tracking-widest">CONTRASEÑA:</label>
                        <input
                            id="password"
                            type="password"
                            class="w-full text-black tracking-widest px-2 h-8 @error('password') is-invalid @enderror"
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

                <div class="flex flex-col justify-center items-center mt-8 space-y-4">
                    <button class="btn--red" type="submit">REGISTRAR TICKET</button>
                    <a class="btn--facebook" href="{{ route('social.auth', 'facebook') }}">
                        CONECTAR CON FACEBOOK
                    </a>
                </div>
        </form>

    </section>
   
                        
@endsection