@extends('layouts.app')

@section('content')

    <section class="section">

        <h1>COMPLETA TU REGISTRO</h1>

        <form class="my-8 w-full" method="POST" action="{{ route('users.update') }}">
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
                                value="{{ old('name', $user->name) }}"
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
                                value="{{ old('middle_name', $user->middle_name) }}"
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
                                value="{{ old('last_name', $user->last_name) }}"
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
                                value="{{ old('email', $user->email) }}"
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
                                value="{{ old('birthday', $user->birthday) }}"
                                required 
                                autocomplete="off" 
                            >
                            @error('birthday')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                    </div>
                    <div class="w-1/2 max-w-sm space-y-4">
                        <div class="w-full">
                            <label for="telephone" class="text-yellow block tracking-widest">TEL??FONO:</label>
                            <input 
                                id="telephone" 
                                type="text" 
                                class="form-input @error('telephone') is-invalid @enderror" 
                                name="telephone" 
                                value="{{ old('telephone', $user->telephone) }}"
                                required 
                                autocomplete="off" 
                            >
                            @error('telephone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="w-full">
                            <label for="street" class="text-yellow block tracking-widest">DOMICILIO:</label>
                            <input 
                                id="street" 
                                type="text" 
                                class="form-input @error('street') is-invalid @enderror" 
                                name="street" 
                                value="{{ old('street', $user->street) }}" 
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
                                value="{{ old('municipality', $user->municipality) }}" 
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
                            <label for="zip_code" class="text-yellow block tracking-widest">C??DIGO POSTAL:</label>
                            <input 
                                id="zip_code" 
                                type="text" 
                                class="form-input @error('zip_code') is-invalid @enderror" 
                                name="zip_code" 
                                value="{{ old('zip_code', $user->zip_code) }}" 
                                required 
                                autocomplete="off" 
                            >
                            @error('zip_code')
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
                                <option value="Ciudad de M??xico" {{ old('state') == 'Ciudad de M??xico' ? 'selected' : '' }}>Ciudad de M??xico</option>
                                <option value="Coahuila" {{ old('state') == 'Coahuila' ? 'selected' : '' }}>Coahuila</option>
                                <option value="Colima" {{ old('state') == 'Colima' ? 'selected' : '' }}>Colima</option>
                                <option value="Durango" {{ old('state') == 'Durango' ? 'selected' : '' }}>Durango</option>
                                <option value="Estado de M??xico" {{ old('state') == 'Estado de M??xico' ? 'selected' : '' }}>Estado de M??xico</option>
                                <option value="Guanajuato" {{ old('state') == 'Guanajuato' ? 'selected' : '' }}>Guanajuato</option>
                                <option value="Guerrero" {{ old('state') == 'Guerrero' ? 'selected' : '' }}>Guerrero</option>
                                <option value="Hidalgo" {{ old('state') == 'Hidalgo' ? 'selected' : '' }}>Hidalgo</option>
                                <option value="Jalisco" {{ old('state') == 'Jalisco' ? 'selected' : '' }}>Jalisco</option>
                                <option value="Michoac??n" {{ old('state') == 'Michoac??n' ? 'selected' : '' }}>Michoac??n</option>
                                <option value="Morelos" {{ old('state') == 'Morelos' ? 'selected' : '' }}>Morelos</option>
                                <option value="Nayarit" {{ old('state') == 'Nayarit' ? 'selected' : '' }}>Nayarit</option>
                                <option value="Nuevo Le??n" {{ old('state') == 'Nuevo Le??n' ? 'selected' : '' }}>Nuevo Le??n</option>
                                <option value="Oaxaca" {{ old('state') == 'Oaxaca' ? 'selected' : '' }}>Oaxaca</option>
                                <option value="Puebla" {{ old('state') == 'Puebla' ? 'selected' : '' }}>Puebla</option>
                                <option value="Quer??taro" {{ old('state') == 'Quer??taro' ? 'selected' : '' }}>Quer??taro</option>
                                <option value="Quintana Roo" {{ old('state') == 'Quintana Roo' ? 'selected' : '' }}>Quintana Roo</option>
                                <option value="San Luis Potos??" {{ old('state') == 'San Luis Potos??' ? 'selected' : '' }}>San Luis Potos??</option>
                                <option value="Sinaloa" {{ old('state') == 'Sinaloa' ? 'selected' : '' }}>Sinaloa</option>
                                <option value="Sonora" {{ old('state') == 'Sonora' ? 'selected' : '' }}>Sonora</option>
                                <option value="Tabasco" {{ old('state') == 'Tabasco' ? 'selected' : '' }}>Tabasco</option>
                                <option value="Tamaulipas" {{ old('state') == 'Tamaulipas' ? 'selected' : '' }}>Tamaulipas</option>
                                <option value="Tlaxcala" {{ old('state') == 'Tlaxcala' ? 'selected' : '' }}>Tlaxcala</option>
                                <option value="Veracruz" {{ old('state') == 'Veracruz' ? 'selected' : '' }}>Veracruz</option>
                                <option value="Yucat??n" {{ old('state') == 'Yucat??n' ? 'selected' : '' }}>Yucat??n</option>
                                <option value="Zacatecas" {{ old('state') == 'Zacatecas' ? 'selected' : '' }}>Zacatecas</option>
                            </select>
                            @error('state')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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
                                Acepto <a class="underline" href="{{ route('terms') }}">T??rminos y condiciones</a>
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
            Recuerda que, de conformidad con los T??rminos y Condiciones, es importante que todos tus datos sean reales y completos
        </div>

    </section>
   
                        
@endsection
