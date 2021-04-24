@extends('layouts.app')

@section('content')

    <div class="registerContainer">
        <div class="registerBanner">
            <div class="registerSection">

                <div class="col-12 p-0 m-0">
                    <div class="generalSectionsTitle">
                        <img src="{{asset('images/register/Logo_Registro.png')}}" alt="Logo_Registro">
                    </div>
                    <div class="registerContain generalSectionsContain">
                        <form class="registerForm col-11 col-sm-8 col-lg-6" method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="dataRegister">
    
    
                                <div class="formRegisterFirstSectionAuth col-12">
    
                                    <div class="nameRegisterGroup">
                                        <div class="col-12 p-0">
                                            <input 
                                                id="name" 
                                                type="text" 
                                                class="generalFormInput @error('name') is-invalid @enderror" 
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
                                        <label
                                            class="generalFormLabel" 
                                            for="name" 
                                        >
                                            {{ __('Nombre:') }}
                                        </label>
                                    </div>
    
                                    <div class="emailRegisterGroup">
                                        <div class="col-12 p-0">
                                            <input 
                                                id="email" 
                                                type="email" 
                                                class="generalFormInput @error('email') is-invalid @enderror" 
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
                                        <label 
                                            class="generalFormLabel"
                                            for="email"
                                        >
                                            {{ __('E-mail:') }}
                                        </label>
                                    </div>
    
                                    <div class="passRegisterGroup">
                                        <div class="col-12 p-0">
                                            <input
                                                id="password"
                                                type="password"
                                                class="generalFormInput @error('password') is-invalid @enderror"
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
                                        <label
                                            class="generalFormLabel" 
                                            for="password" 
                                        >
                                            {{ __('Contraseña:') }}
                                        </label>
                                    </div>
            
                                    <div class="confirmPassRegisterGroup">
                                        <div class="col-12 p-0">
                                            <input 
                                                id="password-confirm" 
                                                type="password" 
                                                class="generalFormInput"
                                                name="password_confirmation" 
                                                required 
                                                autocomplete="off"
                                            >
                                        </div>
                                        <label
                                            class="generalFormLabel" 
                                            for="password-confirm" 
                                        >
                                            {{ __('Confirmación de Contraseña:') }}
                                        </label>
    
                                    </div>
            
                                </div>
    
                            </div>
    
                            <div class="formRegisterThirdSection">
                                <div class="termsCheckGroup col-12 justify-content-end">
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
                                <div class="privacyCheckGroup col-12 justify-content-end">
                                    <input
                                        id="privacyCheck"
                                        type="checkbox"
                                        required
                                    >
                                    <label for="privacyCheck">
                                        &nbsp;&nbsp;Acepto&nbsp;<a href={{route('privacy')}} target="_blank"><u class="p-0 m-0">Aviso de Privacidad</u></a>
                                    </label>
                                </div>
                            </div>
                            
                            <div class="actionButton pb-2">
                                <button type="submit">
                                    {{ __('Registrar')}}
                                </button>    
                            </div>
    
                            <div class="col-12 text-center text-blueSaladitas">
                                <small>o registrese con</small>
                            </div>
    
                            <div class="buttonFBConnect pt-2 pb-3">
                                <a href="{{ route('social.auth', 'facebook') }}">
                                    FACEBOOK
                                </a>
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
