@extends('layouts.app')

@section('content')

    <section class="section">

        <h1>INICIAR SESIÓN</h1>

        <form class="my-8 w-full max-w-sm" method="POST" action="{{ route('login') }}">
                @csrf

                <div class="w-full max-w-md mx-auto space-y-4">

                    <div class="w-full">
                        <label for="email" class="text-yellow block tracking-widest">EMAIL:</label>
                        <input 
                            id="email" 
                            type="email" 
                            class="form-input @error('email') is-invalid @enderror" 
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
                            class="form-input @error('password') is-invalid @enderror"
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
                    <div class="w-full text-right">
                        <a class="font-montserrat text-white text-xs underline text-right" href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                    </div>
                </div>

                <div class="flex flex-col justify-center items-center mt-8 space-y-4">
                    <button class="btn--red" type="submit">INGRESAR</button>
                    <a class="btn--facebook" href="{{ route('social.auth', 'facebook') }}">
                        CONECTAR CON FACEBOOK
                    </a>
                </div>

                <div class=" font-montserrat text-white text-xs text-center mt-8">
                    Si no tienes cuenta 
                    <a class="underline" href="{{ route('register') }}">Registrate aquí</a>
                </div>
        </form>

    </section>
   
                        
@endsection