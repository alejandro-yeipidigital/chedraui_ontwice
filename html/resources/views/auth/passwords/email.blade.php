@extends('layouts.app')

@section('content')

    <section class="section">

        <h1>¿OLVIDASTE TU CONTRASEÑA?</h1>

        <p class="mt-8 tracking-wider">Ingrese su correo electrónico para recibir la liga de reinicio de contraseña.</p>

        @if (session('status'))
            <div class="font-montserrat text-center text-green" role="alert">
                {{ session('status') }}
            </div>
        @endif

            <form class="my-8 w-full max-w-sm" method="POST" action="{{ route('password.email') }}">
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
                </div>

                <div class="flex flex-col justify-center items-center mt-8 space-y-4">
                    <button class="btn--red" type="submit">REESTABLECER</button>
                </div>
        </form>

    </section>
   
                        
@endsection