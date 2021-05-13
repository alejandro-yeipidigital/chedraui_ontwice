@extends('layouts.app')

@section('content')

    <section class="section">

        <h1>¿OLVIDASTE TU CONTRASEÑA?</h1>

            <form method="POST" action="{{ route('password.update') }}" class="my-8 w-full max-w-sm">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

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
                    <div class="w-full">
                        <label for="password-confirm" class="text-yellow block tracking-widest">CONFIRMAR CONTRASEÑA:</label>
                        <input 
                            id="password-confirm" 
                            type="password" 
                            class="form-input"
                            name="password_confirmation" 
                            required 
                            autocomplete="off"
                        >
                    </div>
                </div>

                <div class="flex flex-col justify-center items-center mt-8 space-y-4">
                    <button class="btn--red" type="submit">ENVIAR</button>
                </div>
        </form>

    </section>
   
                        
@endsection