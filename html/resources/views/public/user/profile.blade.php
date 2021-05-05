@extends('layouts.app')


@section('content')

    <section class="container min-h-main flex flex-col justify-center items-center py-12 bg-left-bottom bg-no-repeat" style="background-image: url({{ asset('images/potato.png') }})">

        <h1>PERFIL</h1>
        
        <div class="w-full flex justify-center items-start space-x-8">
            <div class="bg-white text-black w-full max-w-sm rounded-lg border-2 border-yellow py-6 px-8 mt-4">
                <div class="text-black tracking-wider text-center text-4xl">{{ $user->name }}</div>
                <div class="w-40 h-40 rounded-full bg-avatar1 p-3 border-16 border-avatar2 mx-auto my-4">
                    @if ( $user->profile_photo_path == null )
                    <img class="w-full h-full rounded-full object-cover" src="{{ asset('images/avatar.jpg') }}" alt="avatar">
                    @else
                        <img class="w-full h-full rounded-full object-cover" src={{$user->profile_photo_path}} alt="avatar">
                    @endif
                </div>
                <div class="mx-auto text-2xl tracking-wider space-y-4">
                    @if ($uploadedTickets)
                        <div class="flex justify-between items-center">
                            <div class="">POSICIÓN</div>
                            <div>{{ $user_position }}</div>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="">PUNTOS</div>
                            <div>{{ $user_points }}</div>
                        </div>
                        <div class="flex justify-between items-center">
                            <div>TICKETS REGISTRADOS</div>
                            <div>{{ $tickets_validated }}</div>
                        </div>
                    @else
                        <div class="text-center mb-2">USTED NO CUENTA CON TICKETS REGISTRADOS</div>
                    @endif
                </div>
            </div> 

            <div class="bg-white text-black w-full max-w-sm rounded-lg border-2 border-yellow py-6 px-8 mt-4">
                <div class="text-black tracking-wider text-center text-4xl">TICKETS</div>
                
                @if ( $uploadedTickets &&  count($tickets)>0)
                    <table class="w-full text-center tracking-wider mt-4">
                        <thead>
                            <tr class="text-red text-xl">
                                <th># TICKET</th>
                                <th>ESTATUS</th>
                                <th>FECHA</th>
                                <th>PUNTOS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tickets as $ticket)
                                <tr class="text-lg">
                                    <td>
                                        <h3>{{ $ticket->ticket_code }}</h3>
                                    </td>
                                    <td>
                                        @if ($ticket->validation == 1)
                                            <h3>Pendiente</h3>
                                        @elseif ($ticket->validation == 2)
                                            <h3>Valido</h3>
                                        @else
                                            <h3>Rechazado</h3>
                                        @endif
                                    </td>
                                    <td><h3>{{ $ticket->created_at->format('Y-m-d') }}</h3></td>
                                    <td>
                                        <h3>{{ $ticket->total_points }}</h3>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="flex justify-center items-center flex-col text-center mt-4">
                        <div class="text-2xl tracking-wider">USTED NO CUENTA CON TICKETS REGISTRADOS</div>
                        <a href="{{ route('tickets.index') }}" class="btn--red mt-4">REGISTRAR TICKET</a>
                    </div>
                @endif

            </div> 
        </div>

    </section>

@endsection


@section('scripts')  
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        @if ( session('status.alert') ) 
            Swal.fire({
                icon: "{{ session('status.status') }}",
                html: "{{ session('status.message') }}",
                showConfirmButton: true,
                confirmButtonText:'Aceptar',
            })
        @endif
    </script>
@endsection