@extends('layouts.app')

@section('content')

    <section class="section">

        <h1>REGISTRA TU TICKET</h1>
        <form class="my-8 w-full max-w-sm" action="{{ route('tickets.upload') }}" enctype="multipart/form-data" method="POST">
            @csrf

                <div class="w-full max-w-md mx-auto space-y-4">
                    <div class="w-full">
                        <label for="ticket_code" class="text-yellow block tracking-widest">NÚMERO DE TICKET:</label>
                        <input 
                            id="ticket_code" 
                            type="text" 
                            class="form-input @error('email') is-invalid @enderror" 
                            name="ticket_code" 
                            value="{{ old('ticket_code') }}" 
                            required 
                        >
                        @error('ticket_code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="w-full">
                        <div class="relative w-full cursor-pointer h-8">
                            <div class="absolute top-0 left-0 w-full h-full bg-yellow-gradient flex flex-col justify-center items-center text-xl tracking-wider" id="ticketUploadBtn">
                                SELECCIONAR TICKET
                            </div>
                            <input
                                class="bg-white w-full h-full opacity-0 cursor-pointer"
                                type="file"
                                name="ticket"
                                value="{{ old('ticket') }}"
                                accept="image/*"
                                id="ticketInput"
                                required
                            >
                        </div>
                        @error('ticket')
                            <span class="col-12 text-center text-danger" role="alert">
                                <strong><i>{{ $message }}</i></strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="mt-8 font-montserrat text-xs">
                        <i>*Solo serán validadas las fotografías de los tickets, todo ticket que sea escaneado será rechazado.</i>
                    </div>
                </div>

                <div class="flex flex-col justify-center items-center mt-8 space-y-4">
                    <button class="btn--red" type="submit">REGISTRAR TICKET</button>
                </div>
        </form>

    </section>
                
@endsection


@section('scripts')
    <script>
        $(document).ready(function(){
            // alert('si'); 
            function isInputEmpty(){
                if ($('#ticketInput').get(0).files.length == 0 ) {
                    $('#ticketUploadBtn').html('Seleccionar Ticket');

                    $('#ticketUploadBtn').removeClass('bg-green');
                    $('#ticketUploadBtn').addClass('bg-yellow-gradient');
                } else {
                    $('#ticketUploadBtn').html('Ticket Seleccionado')

                    $('#ticketUploadBtn').removeClass('bg-yellow-gradient');
                    $('#ticketUploadBtn').addClass('bg-green');
                }
            }

            $('#ticketUploadBtn').click(function(){
                $('.ticketInput').click()
            });

            $('#ticketInput').change(function(){
                isInputEmpty();
            })

            isInputEmpty();

        });
    </script>
@endsection
