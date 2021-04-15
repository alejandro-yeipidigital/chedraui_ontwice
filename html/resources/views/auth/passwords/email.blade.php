@extends('layouts.app')

@section('content')
    <div class="registerTicketContainer">
        <div class="registerTicketBanner">
            <div class="registerTicketSection">

                <div class="row col-12 p-0 m-0 justify-content-center">

                    <div class="generalSectionsTitle">
                        <h1>¿OLVIDASTE TU CONTRASEÑA?</h1>
                    </div>

                    <div class="registerTicketContain generalSectionsContain">
                        <form class="registerTicketForm" method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="registerTicketFormContain">
                                <div class="ticketNameGroup">
                                    @error('email')
                                        <span class="col-12 text-center text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div class="text-blueSaladitas">
                                        <small class="font-weight-bold">
                                            <i>Ingrese su correo electrónico para recibir la liga de reinicio de contraseña.</i>
                                        </small>
                                    </div>
                                    <input 
                                        class="generalFormInput" 
                                        type="email" 
                                        name="email" 
                                        id="email" 
                                        autocomplete="off" 
                                        title="Ingrese su email"
                                        value="{{ old('email') }}" 
                                        required 
                                    >
                                    <label
                                        class="generalFormLabel"
                                        for="email"
                                    >
                                        {{ __('E-Mail') }}
                                    </label>
                                </div>
                                <div class="actionButtonDark pt-5 pb-5">
                                    <button type="submit">
                                        {{ __('Enviarme liga de reinicio') }}
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