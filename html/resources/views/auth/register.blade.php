@extends('layouts.app')

@section('content')

    <section class="container min-h-main flex flex-col justify-center items-center py-12 bg-left-bottom bg-no-repeat" style="background-image: url({{ asset('images/potato.png') }})">

        <h1>REGÍSTRATE</h1>

        <form class="my-8" method="POST" action="{{ route('register') }}">
            @csrf

                <div class="w-full max-w-md mx-auto space-y-4">

                    <div class="w-full">
                        <label for="name" class="text-yellow block tracking-widest">NOMBRE:</label>
                        <input 
                            id="name" 
                            type="text" 
                            class="w-full text-black tracking-widest px-2 h-8 @error('name') is-invalid @enderror" 
                            name="name" 
                            value="{{ old('name') }}" 
                            required 
                            autocomplete="off" 
                        >
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
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

                    <div class="w-full">
                        <label for="password-confirm" class="text-yellow block tracking-widest">CONFIRMAR CONTRASEÑA:</label>
                        <input 
                            id="password-confirm" 
                            type="password" 
                            class="w-full text-black tracking-widest px-2 h-8"
                            name="password_confirmation" 
                            required 
                            autocomplete="off"
                        >
                    </div>

                    <div class="w-full">
                        <label for="aviso" class="text-white text-xs block font-montserrat">
                            <input
                                id="aviso"
                                name="aviso_privacidad"
                                type="checkbox"
                                class="mr-1"
                                required
                            >
                            Acepto <a class="underline" href="#">Aviso de privacidad</a>
                        </label>
                    </div>

                    <div class="w-full">
                        <label for="tyc" class="text-white text-xs block font-montserrat">
                            <input
                                id="aviso"
                                name="tyc"
                                type="checkbox"
                                class="mr-1"
                                required
                            >
                            Acepto <a class="underline" href="#">Términos y condiciones</a>
                        </label>
                    </div>
                </div>

                <div class="flex flex-col justify-center items-center mt-8 space-y-4">
                    <button class="btn--red" type="submit">REGISTRAR TICKET</button>
                    <a class="btn--facebook" href="{{ route('social.auth', 'facebook') }}">
                        CONECTAR CON FACEBOOK
                    </a>
                </div>
        </form>

        <div class=" max-w-xl mx-auto text-yellow tracking-widest text-center mt-16">
            Recuerda que, de conformidad con los Términos y Condiciones, es importante que todos tus datos sean reales y completos
        </div>

    </section>
   
                        
@endsection
