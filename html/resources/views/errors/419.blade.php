@extends('layouts.app')

@section('content')

    <div class="registerTicketContainer">
        <div class="registerTicketBanner">
            <div class="registerTicketSection">

                <div class="row col-12 p-0 m-0 text-center justify-content-center">
                    <div class="generalSectionsTitle">
                        <h1>TU SESIÓN EXPIRÓ</h1>
                    </div>
                    <div class="registerTicketContain generalSectionsContain">
                        <div class="actionButtonDark">
                            <a href="{{ route('home') }}">IR A INICIO</a>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

@endsection