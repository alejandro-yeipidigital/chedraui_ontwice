@extends('layouts.app')


@section('content')

    <div class="registerTicketContainer">
        <div class="registerTicketBanner">
            <div class="registerTicketSection">

                <div class="row col-12 p-0 m-0 pt-3 pb-3">
                    <div class="generalSectionsTitle">
                        <img src="{{asset('images/registerTicket/Logo_RegistrarTicket.png')}}" alt="Logo_Registro">
                    </div>

                    <div class="registerTicketContain generalSectionsContain">
                        <form class="registerTicketForm" action="{{ route('tickets.upload') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="registerTicketFormContain">
                                <div class="ticketNameGroup">
                                    @error('ticket_code')
                                        <span class="col-12 text-center text-danger" role="alert">
                                            <strong><i>{{ $message }}</i></strong>
                                        </span>
                                    @enderror
                                    <input 
                                        class="generalFormInput"
                                        type="text" 
                                        name="ticket_code"
                                        id="ticket_codeId"
                                        autocomplete="off"
                                        title="Ingrese el número de ticket"
                                        value="{{ old('ticket_code') }}"
                                        required
                                    >
                                    <label
                                        class="generalFormLabel pt-4"
                                        for="ticket_codeId"
                                    >
                                        Número de ticket:
                                    </label>
                                </div>
                                <div class="col-12 p-0 m-0 text-blueSaladitas text-justify">
                                    <small class="font-weight-bold">
                                        <i>*Solo serán validadas las fotografías de los tickets, todo ticket que sea escaneado será rechazado.</i>
                                    </small>
                                </div>
                                <div class="ticketButtonGroup">
                                    <input
                                        class="ticketSelectedInput"
                                        type="file"
                                        name="ticket"
                                        value="{{ old('ticket') }}"
                                        accept="image/*"
                                        required
                                    >
                                    <div class="actionButton pt-4">
                                        <button type="button" id="selectTicketBtn">
                                            <span id="labelSelectTicket">
                                            </span>
                                        </button>
                                    </div>

                                    @error('ticket')
                                        <span class="col-12 text-center text-danger" role="alert">
                                            <strong><i>{{ $message }}</i></strong>
                                        </span>
                                    @enderror

                                    <div class="actionButtonDark pt-4 pb-5">
                                        <button type="submit">
                                            ENVIAR
                                        </button>
                                    </div>
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


@section('scripts')
    <script>
        $(document).ready(function(){

            function isInputEmpty(){
                if ($('.ticketSelectedInput').get(0).files.length == 0 ) {
                    $('#labelSelectTicket').html('Seleccionar Ticket');
                } else {
                    $('#labelSelectTicket').html('Ticket Seleccionado &nbsp;<i class="fas fa-check"></i>')
                    $('#selectTicketBtn').addClass('bg-success');
                }
            }

            $('#selectTicketBtn').click(function(){
                $('.ticketSelectedInput').click()
            });

            $('.ticketSelectedInput').change(function(){
                isInputEmpty();
            })

            isInputEmpty();

        });
    </script>
@endsection
