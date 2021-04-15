@extends('layouts.app')

@section('content')

<div class="registerTicketContainer">
    <div class="registerTicketBanner">
        <div class="registerTicketSection">


            <div class="row col-12 p-0 m-0 justify-content-center">
                <div class="generalSectionsTitle">
                    <h1>REINICIA TU CONTRASEÑA</h1>
                </div>

                <div class="registerTicketContain generalSectionsContain">
                    <form class="registerTicketForm col-10 col-sm-7 col-md-7 col-lg-4" method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <div class="registerTicketFormContain">
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="ticketNameGroup">
                                @error('email')
                                    <span class="col-12 text-center text-danger" role="alert">
                                        <strong><i>{{ $message }}</i></strong>
                                    </span>
                                @enderror
                                <input 
                                    class="generalFormInput @error('email') is-invalid @enderror" 
                                    id="email"
                                    type="email" 
                                    name="email" 
                                    value="{{ $email ?? old('email') }}" 
                                    required 
                                    autocomplete="off" 
                                >
                                <label for="email" class="generalFormLabel">{{ __('Correo electrónico') }}</label>
                            </div>

                            <div class="ticketNameGroup">
                                @error('password')
                                    <span class="col-12 text-center text-danger" role="alert">
                                        <strong><i>{{ $message }}</i></strong>
                                    </span>
                                @enderror
                                <input 
                                    class="generalFormInput @error('password') is-invalid @enderror" 
                                    id="password" 
                                    type="password" 
                                    name="password" 
                                    required 
                                    autocomplete="off"
                                >
                                <label for="password" class="generalFormLabel">{{ __('Nueva contraseña') }}</label>
                            </div>

                            <div class="ticketNameGroup">
                                <input 
                                    class="generalFormInput" 
                                    id="password-confirm" 
                                    type="password" 
                                    name="password_confirmation" 
                                    required 
                                    autocomplete="off"
                                >
                                <label for="password-confirm" class="generalFormLabel">{{ __('Confirma tu contraseña') }}</label>
                            </div>
                            <br>
                            <div class="actionButton pb-3">
                                <button class="font-weight-bold" type="submit">
                                    {{ __('Reiniciar contraseña') }}
                                </button>
                            </div>

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
