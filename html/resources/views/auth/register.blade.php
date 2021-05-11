@extends('layouts.app')

@section('content')

    <section class="section">

        <h1>REGÍSTRATE</h1>

        <form class="my-8 w-full" method="POST" action="{{ route('register') }}">
            @csrf

                <div class="w-full mx-auto flex flex-wrap justify-center items-start space-x-8">

                    <div class="w-1/2 max-w-sm space-y-4">
                        <div class="w-full">
                            <label for="name" class="text-yellow block tracking-widest">NOMBRE:</label>
                            <input 
                                id="name" 
                                type="text" 
                                class="form-input @error('name') is-invalid @enderror" 
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
                            <label for="middle_name" class="text-yellow block tracking-widest">APELLIDO PATERNO:</label>
                            <input 
                                id="middle_name" 
                                type="text" 
                                class="form-input @error('middle_name') is-invalid @enderror" 
                                name="middle_name" 
                                value="{{ old('middle_name') }}" 
                                required 
                                autocomplete="off" 
                            >
                            @error('middle_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="w-full">
                            <label for="last_name" class="text-yellow block tracking-widest">APELLIDO MATERNO:</label>
                            <input 
                                id="last_name" 
                                type="text" 
                                class="form-input @error('last_name') is-invalid @enderror" 
                                name="last_name" 
                                value="{{ old('last_name') }}" 
                                required 
                                autocomplete="off" 
                            >
                            @error('last_name')
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
                            <label for="birthdayRegisterInput" class="text-yellow block tracking-widest">FECHA DE NACIMIENTO:</label>
                            <input 
                                id="birthdayRegisterInput" 
                                type="text" 
                                class="form-input @error('birthday') is-invalid @enderror" 
                                name="birthday" 
                                value="{{ old('birthday') }}" 
                                required 
                                autocomplete="off" 
                            >
                            @error('birthday')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="w-full">
                            <label for="zip_code" class="text-yellow block tracking-widest">CÓDIGO POSTAL:</label>
                            <input 
                                id="zip_code" 
                                type="text" 
                                class="form-input @error('zip_code') is-invalid @enderror" 
                                name="zip_code" 
                                value="{{ old('zip_code') }}" 
                                required 
                                autocomplete="off" 
                            >
                            @error('zip_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="w-1/2 max-w-sm space-y-4">
                        <div class="w-full">
                            <label for="street" class="text-yellow block tracking-widest">CALLE:</label>
                            <input 
                                id="street" 
                                type="text" 
                                class="form-input @error('street') is-invalid @enderror" 
                                name="street" 
                                value="{{ old('street') }}" 
                                required 
                                autocomplete="off" 
                            >
                            @error('street')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="w-full">
                            <label for="municipality" class="text-yellow block tracking-widest">MUNICIPIO:</label>
                            <input 
                                id="municipality" 
                                type="text" 
                                class="form-input @error('municipality') is-invalid @enderror" 
                                name="municipality" 
                                value="{{ old('municipality') }}" 
                                required 
                                autocomplete="off" 
                            >
                            @error('municipality')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="w-full">
                            <label for="state" class="text-yellow block tracking-widest">ESTADO:</label>
                            <select name="state" id="state" class="form-input" required>
                                <option value="" disabled {{ old('state') ? '': 'selected' }}>Elige tu estado</option>
                                <option value="Aguascalientes" {{ old('state') == 'Aguascalientes' ? 'selected' : '' }}>Aguascalientes</option>
                                <option value="Baja California" {{ old('state') == 'Baja California' ? 'selected' : '' }}>Baja California</option>
                                <option value="Baja California Sur" {{ old('state') == 'Baja California Sur' ? 'selected' : '' }}>Baja California Sur</option>
                                <option value="Campeche" {{ old('state') == 'Campeche' ? 'selected' : '' }}>Campeche</option>
                                <option value="Chiapas" {{ old('state') == 'Chiapas' ? 'selected' : '' }}>Chiapas</option>
                                <option value="Chihuahua" {{ old('state') == 'Chihuahua' ? 'selected' : '' }}>Chihuahua</option>
                                <option value="Ciudad de México" {{ old('state') == 'Ciudad de México' ? 'selected' : '' }}>Ciudad de México</option>
                                <option value="Coahuila" {{ old('state') == 'Coahuila' ? 'selected' : '' }}>Coahuila</option>
                                <option value="Colima" {{ old('state') == 'Colima' ? 'selected' : '' }}>Colima</option>
                                <option value="Durango" {{ old('state') == 'Durango' ? 'selected' : '' }}>Durango</option>
                                <option value="Estado de México" {{ old('state') == 'Estado de México' ? 'selected' : '' }}>Estado de México</option>
                                <option value="Guanajuato" {{ old('state') == 'Guanajuato' ? 'selected' : '' }}>Guanajuato</option>
                                <option value="Guerrero" {{ old('state') == 'Guerrero' ? 'selected' : '' }}>Guerrero</option>
                                <option value="Hidalgo" {{ old('state') == 'Hidalgo' ? 'selected' : '' }}>Hidalgo</option>
                                <option value="Jalisco" {{ old('state') == 'Jalisco' ? 'selected' : '' }}>Jalisco</option>
                                <option value="Michoacán" {{ old('state') == 'Michoacán' ? 'selected' : '' }}>Michoacán</option>
                                <option value="Morelos" {{ old('state') == 'Morelos' ? 'selected' : '' }}>Morelos</option>
                                <option value="Nayarit" {{ old('state') == 'Nayarit' ? 'selected' : '' }}>Nayarit</option>
                                <option value="Nuevo León" {{ old('state') == 'Nuevo León' ? 'selected' : '' }}>Nuevo León</option>
                                <option value="Oaxaca" {{ old('state') == 'Oaxaca' ? 'selected' : '' }}>Oaxaca</option>
                                <option value="Puebla" {{ old('state') == 'Puebla' ? 'selected' : '' }}>Puebla</option>
                                <option value="Querétaro" {{ old('state') == 'Querétaro' ? 'selected' : '' }}>Querétaro</option>
                                <option value="Quintana Roo" {{ old('state') == 'Quintana Roo' ? 'selected' : '' }}>Quintana Roo</option>
                                <option value="San Luis Potosí" {{ old('state') == 'San Luis Potosí' ? 'selected' : '' }}>San Luis Potosí</option>
                                <option value="Sinaloa" {{ old('state') == 'Sinaloa' ? 'selected' : '' }}>Sinaloa</option>
                                <option value="Sonora" {{ old('state') == 'Sonora' ? 'selected' : '' }}>Sonora</option>
                                <option value="Tabasco" {{ old('state') == 'Tabasco' ? 'selected' : '' }}>Tabasco</option>
                                <option value="Tamaulipas" {{ old('state') == 'Tamaulipas' ? 'selected' : '' }}>Tamaulipas</option>
                                <option value="Tlaxcala" {{ old('state') == 'Tlaxcala' ? 'selected' : '' }}>Tlaxcala</option>
                                <option value="Veracruz" {{ old('state') == 'Veracruz' ? 'selected' : '' }}>Veracruz</option>
                                <option value="Yucatán" {{ old('state') == 'Yucatán' ? 'selected' : '' }}>Yucatán</option>
                                <option value="Zacatecas" {{ old('state') == 'Zacatecas' ? 'selected' : '' }}>Zacatecas</option>
                            </select>
                            @error('state')
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
                        <div class="w-full text-right">
                            <label for="aviso" class="text-white text-xs block font-montserrat">
                                <input
                                    id="aviso"
                                    name="aviso_privacidad"
                                    type="checkbox"
                                    class="mr-1"
                                    required
                                >
                                Acepto <a class="underline" href="{{ route('privacy') }}">Aviso de privacidad</a>
                            </label>
                        </div>

                        <div class="w-full text-right">
                            <label for="tyc" class="text-white text-xs block font-montserrat">
                                <input
                                    id="aviso"
                                    name="tyc"
                                    type="checkbox"
                                    class="mr-1"
                                    required
                                >
                                Acepto <a class="underline" href="{{ route('terms') }}">Términos y condiciones</a>
                            </label>
                        </div>
                    </div>

                </div>

                <div class="flex flex-col justify-center items-center mt-8 space-y-4">
                    <button class="btn--red" type="submit">REGISTRAR</button>
                    <a class="btn--facebook" href="{{ route('social.auth', 'facebook') }}">
                        CONECTAR CON FACEBOOK
                    </a>
                </div>
        </form>

        <div class="font-montserrat max-w-xl mx-auto text-yellow tracking-widest text-center mt-8 text-xs">
            Recuerda que, de conformidad con los Términos y Condiciones, es importante que todos tus datos sean reales y completos
        </div>

    </section>
   
                        
@endsection
