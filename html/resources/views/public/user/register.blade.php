@extends('layouts.app')

@section('content')

    <div class="registerContainer">
        <div class="registerBanner">
            <div class="registerSection">

                <div class="row col-12 p-0 m-0 pt-5 pb-5">
                    <div class="generalSectionsTitle">
                        <img src="{{asset('images/register/Logo_Registro.png')}}" alt="Logo_Registro">
                    </div>

                    <div class="registerContain generalSectionsContain">

                        <form class="registerForm col-11 col-lg-10 " action="{{ route('users.update') }}" method="post">
                            @csrf
                            <div class="dataRegister">
        
                                <div class="formRegisterFirstSection">
                                    
                                    <div class="nameRegisterGroup">
                                        @error('name')
                                            <span class="col-12 text-center text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <input
                                            class="generalFormInput"
                                            type="text"
                                            name="name"
                                            id="nameRegisterInput"
                                            autocomplete="off"
                                            title="Ingrese su nombre"
                                            value="{{ old('name', $user->name) }}"
                                        >
                                        <label
                                            class="generalFormLabel"
                                            for="nameRegisterInput">
                                            Nombre:
                                        </label>
                                    </div>
            
                                    <div class="fatherLastNameRegisterGroup">
                                        @error('middle_name')
                                            <span class="col-12 text-center text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <input
                                            class="generalFormInput"
                                            type="text"
                                            name="middle_name"
                                            id="fatherLastNameRegisterInput"
                                            autocomplete="off"
                                            title="Ingrese su apellido paterno"
                                            value="{{ old('middle_name', $user->middle_name) }}"
                                        >
                                        <label
                                            class="generalFormLabel" 
                                            for="fatherLastNameRegisterInput">
                                            Apellido Paterno:
                                        </label>
                                    </div>
            
                                    <div class="motherLastNameRegisterGroup">
                                        @error('last_name')
                                            <span class="col-12 text-center text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror        
                                        <input
                                            class="generalFormInput"
                                            type="text"
                                            name="last_name"
                                            id="motherLastNameRegisterInput"
                                            autocomplete="off"
                                            title="Ingrese su apellido materno"
                                            value="{{ old('last_name', $user->last_name) }}"
                                        >
                                        <label
                                            class="generalFormLabel" 
                                            for="motherLastNameRegisterInput">
                                            Apellido Materno:
                                        </label>
                                    </div>
                                    
                                    
                                    {{-- <div class="sizeRegisterGroup">
                                        @error('size')
                                            <span class="col-12 text-center text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <select 
                                            class="generalFormInput"
                                            name="size" 
                                            id="sizeRegisterInput"
                                            title="Seleccione su talla"
                                        >
                                            <option value="" disabled {{ old('size', $user->size) ? '': 'selected' }}>Elige una opción</option>
                                            <option value="S" {{ old('size', $user->size) == 'S' ? 'selected' : '' }}>S</option>
                                            <option value="M" {{ old('size', $user->size) == 'M' ? 'selected' : '' }}>M</option>
                                            <option value="G" {{ old('size', $user->size) == 'G' ? 'selected' : '' }}>G</option>
                                        </select>
                                        <label 
                                            class="generalFormLabel" 
                                            for="birthdayRegisterInput">
                                            Talla:
                                        </label>
                                    </div> --}}

                                </div>
            
                                <div class="formRegisterSecondSection">
            
                                    <div class="emailRegisterGroup">
                                        <input
                                            class="generalFormInput"
                                            type="email"
                                            id="emailRegisterInput"
                                            value="{{ old('email', $user->email) }}"
                                            disabled
                                        >
                                        <label
                                            class="generalFormLabel" 
                                            for="emailRegisterInput">
                                            E-mail:
                                        </label>
                                    </div>

                                    <div class="telephoneRegisterGroup">
                                        @error('telephone')
                                            <span class="col-12 text-center text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror        
                                        <input
                                            class="generalFormInput"
                                            type="text"
                                            name="telephone"
                                            id="telephoneRegisterInput"
                                            autocomplete="off"
                                            title="Ingrese su teléfono"
                                            value="{{ old('telephone', $user->telephone) }}"
                                        >
                                        <label
                                            class="generalFormLabel" 
                                            for="telephoneRegisterInput">
                                            Teléfono
                                        </label>
                                    </div>

                                    <div class="birthdayRegisterGroup">
                                        @error('birthday')
                                            <span class="col-12 text-center text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror        
                                        <input
                                            class="generalFormInput"
                                            type="text"
                                            name="birthday"
                                            id="birthdayRegisterInput"
                                            min="1920-01-01"
                                            max="2002-01-01"
                                            title="Ingrese su fecha de nacimiento"
                                            value="{{ old('birthday', $user->birthday) }}"
                                        >
                                        <label
                                            class="generalFormLabel" 
                                            for="birthdayRegisterInput"
                                        >
                                            Fecha de Nacimiento:
                                        </label>
                                    </div>

                                    {{-- <div class="streetRegisterGroup">
                                        @error('street')
                                            <span class="col-12 text-center text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <input 
                                            class="generalFormInput"
                                            type="text"
                                            name="street" 
                                            id="streetRegisterInput"
                                            title="Ingrese su calle"
                                            value="{{ old('street', $user->street) }}" 
                                        >
                                        <label 
                                            for="streetRegisterInput" 
                                            class="generalFormLabel"
                                        >
                                            Calle:
                                        </label>
                                    </div>

                                    <div class="extNumberRegisterGroup">
                                        @error('number_ext')
                                            <span class="col-12 text-center text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <input 
                                            class="generalFormInput"
                                            type="text"
                                            name="number_ext" 
                                            id="extNumberRegisterInput"
                                            title="Ingrese su número exterior"
                                            value="{{ old('number_ext', $user->number_ext) }}" 
                                        >
                                        <label 
                                            for="extNumberRegisterInput" 
                                            class="generalFormLabel"
                                        >
                                            Número Exterior:
                                        </label>
                                    </div>

                                    <div class="intNumberRegisterGroup">
                                        <input 
                                            class="generalFormInput"
                                            type="text"
                                            name="number_int" 
                                            id="intNumberRegisterInput"
                                            title="Ingrese su número interior"
                                            value="{{ old('number_int', $user->number_int) }}" 
                                        >
                                        <label 
                                            for="intNumberRegisterInput" 
                                            class="generalFormLabel"
                                        >
                                            Número Interior:
                                        </label>
                                    </div>
    
                                    <div class="zipRegisterGroup">
                                        @error('zip_code')
                                            <span class="col-12 text-center text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <input
                                            class="generalFormInput"
                                            type="text"
                                            name="zip_code"
                                            id="zipRegisterInput"
                                            autocomplete="off"
                                            title="Ingrese su código postal"
                                            value="{{ old('zip_code', $user->zip_code) }}"
                                        >
                                        <label
                                            class="generalFormLabel"
                                            for="zipRegisterInput">
                                            Código Postal:
                                        </label>
                                    </div>           

                                    <div class="neighborhoodRegisterGroup">
                                        @error('neighborhood')
                                            <span class="col-12 text-center text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror        
                                        <input
                                            class="generalFormInput"
                                            type="text"
                                            name="neighborhood"
                                            id="neighborhoodRegisterInput"
                                            autocomplete="off"
                                            title="Ingrese su colonia"
                                            value="{{ old('neighborhood', $user->neighborhood) }}"
                                        >
                                        <label
                                            class="generalFormLabel"
                                            for="neighborhoodRegisterInput">
                                            Colonia:
                                        </label>
                                    </div>

                                    <div class="neighborhoodRegisterGroup">
                                        @error('municipality')
                                            <span class="col-12 text-center text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror        
                                        <input
                                            class="generalFormInput"
                                            type="text"
                                            name="municipality"
                                            id="municipalityRegisterInput"
                                            autocomplete="off"
                                            title="Ingrese su municipio"
                                            value="{{ old('municipality', $user->municipality) }}"
                                        >
                                        <label
                                            class="generalFormLabel"
                                            for="municipalityRegisterInput">
                                            Municipio o Delegación:
                                        </label>
                                    </div>

                                    <div class="stateRegisterGroup">
                                        @error('state')
                                            <span class="col-12 text-center text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <select
                                            class="generalFormInput" 
                                            id="state" 
                                            name="state" 
                                        >
                                            <option value="" disabled {{ old('state', $user->state) ? '': 'selected' }}>Elige una opción</option>
                                            <option value="Aguascalientes" {{ old('state', $user->state) == 'Aguascalientes' ? 'selected' : '' }}>Aguascalientes</option>
                                            <option value="Baja California" {{ old('state', $user->state) == 'Baja California' ? 'selected' : '' }}>Baja California</option>
                                            <option value="Baja California Sur" {{ old('state', $user->state) == 'Baja California Sur' ? 'selected' : '' }}>Baja California Sur</option>
                                            <option value="Campeche" {{ old('state', $user->state) == 'Campeche' ? 'selected' : '' }}>Campeche</option>
                                            <option value="Chiapas" {{ old('state', $user->state) == 'Chiapas' ? 'selected' : '' }}>Chiapas</option>
                                            <option value="Chihuahua" {{ old('state', $user->state) == 'Chihuahua' ? 'selected' : '' }}>Chihuahua</option>
                                            <option value="Ciudad de México" {{ old('state', $user->state) == 'Ciudad de México' ? 'selected' : '' }}>Ciudad de México</option>
                                            <option value="Coahuila" {{ old('state', $user->state) == 'Coahuila' ? 'selected' : '' }}>Coahuila</option>
                                            <option value="Colima" {{ old('state', $user->state) == 'Colima' ? 'selected' : '' }}>Colima</option>
                                            <option value="Durango" {{ old('state', $user->state) == 'Durango' ? 'selected' : '' }}>Durango</option>
                                            <option value="Estado de México" {{ old('state', $user->state) == 'Estado de México' ? 'selected' : '' }}>Estado de México</option>
                                            <option value="Guanajuato" {{ old('state', $user->state) == 'Guanajuato' ? 'selected' : '' }}>Guanajuato</option>
                                            <option value="Guerrero" {{ old('state', $user->state) == 'Guerrero' ? 'selected' : '' }}>Guerrero</option>
                                            <option value="Hidalgo" {{ old('state', $user->state) == 'Hidalgo' ? 'selected' : '' }}>Hidalgo</option>
                                            <option value="Jalisco" {{ old('state', $user->state) == 'Jalisco' ? 'selected' : '' }}>Jalisco</option>
                                            <option value="Michoacán" {{ old('state', $user->state) == 'Michoacán' ? 'selected' : '' }}>Michoacán</option>
                                            <option value="Morelos" {{ old('state', $user->state) == 'Morelos' ? 'selected' : '' }}>Morelos</option>
                                            <option value="Nayarit" {{ old('state', $user->state) == 'Nayarit' ? 'selected' : '' }}>Nayarit</option>
                                            <option value="Nuevo León" {{ old('state', $user->state) == 'Nuevo León' ? 'selected' : '' }}>Nuevo León</option>
                                            <option value="Oaxaca" {{ old('state', $user->state) == 'Oaxaca' ? 'selected' : '' }}>Oaxaca</option>
                                            <option value="Puebla" {{ old('state', $user->state) == 'Puebla' ? 'selected' : '' }}>Puebla</option>
                                            <option value="Querétaro" {{ old('state', $user->state) == 'Querétaro' ? 'selected' : '' }}>Querétaro</option>
                                            <option value="Quintana Roo" {{ old('state', $user->state) == 'Quintana Roo' ? 'selected' : '' }}>Quintana Roo</option>
                                            <option value="San Luis Potosí" {{ old('state', $user->state) == 'San Luis Potosí' ? 'selected' : '' }}>San Luis Potosí</option>
                                            <option value="Sinaloa" {{ old('state', $user->state) == 'Sinaloa' ? 'selected' : '' }}>Sinaloa</option>
                                            <option value="Sonora" {{ old('state', $user->state) == 'Sonora' ? 'selected' : '' }}>Sonora</option>
                                            <option value="Tabasco" {{ old('state', $user->state) == 'Tabasco' ? 'selected' : '' }}>Tabasco</option>
                                            <option value="Tamaulipas" {{ old('state', $user->state) == 'Tamaulipas' ? 'selected' : '' }}>Tamaulipas</option>
                                            <option value="Tlaxcala" {{ old('state', $user->state) == 'Tlaxcala' ? 'selected' : '' }}>Tlaxcala</option>
                                            <option value="Veracruz" {{ old('state', $user->state) == 'Veracruz' ? 'selected' : '' }}>Veracruz</option>
                                            <option value="Yucatán" {{ old('state', $user->state) == 'Yucatán' ? 'selected' : '' }}>Yucatán</option>
                                            <option value="Zacatecas" {{ old('state', $user->state) == 'Zacatecas' ? 'selected' : '' }}>Zacatecas</option>
                                        </select>
                                        <label 
                                            for="state" 
                                            class="generalFormLabel">
                                            Estado:
                                        </label>
                                    </div> --}}
        
                                </div>
        
                            </div>

                            <div class="formRegisterThirdSection">
                                <div class="termsCheckGroup justify-content-end">
                                    <input
                                        id="termsCheck"
                                        type="checkbox"
                                        required
                                    >
                                    <label
                                        for="termsCheck"
                                    >
                                        &nbsp;&nbsp;Acepto&nbsp;<a href={{route('terms')}} target="_blank"><u class="p-0 m-0">Términos y Condiciones</u></a>
                                    </label>
                                </div>
                                <div class="privacyCheckGroup justify-content-end">
                                    <input
                                        id="privacyCheck"
                                        type="checkbox"
                                        required
                                    >
                                    <label for="privacyCheck">
                                        &nbsp;&nbsp;Acepto&nbsp;<a href={{route('privacy')}} target="_blank"><u>Aviso de Privacidad</u></a>
                                    </label>
                                </div>
                            </div>
        
                            <div class="actionButton pb-3">
                                <button type="submit">
                                    Registrar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="generalLogoCookie">
                    <img src="{{asset('images/general/Logo_Cookie.png')}}" alt="Logo_Cookie">
                </div>    

            </div>
        </div>
    </div>

@endsection