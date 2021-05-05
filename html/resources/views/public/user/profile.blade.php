@extends('layouts.app')


@section('content')

    <section class="container min-h-main flex flex-col justify-center items-center py-12 bg-left-bottom bg-no-repeat" style="background-image: url({{ asset('images/potato.png') }})">

        <h1>PERFIL</h1>
        
        <div class="w-full flex justify-center items-start space-x-8">
            <div class="bg-white text-black w-full max-w-sm rounded-lg border-2 border-yellow py-6 px-8 mt-4">
                <div class="text-black tracking-wider text-center text-4xl">{{ $user->name }}</div>
                <div class="w-48 h-48 rounded-full bg-avatar1 p-3 border-16 border-avatar2 mx-auto my-4">
                    @if ( $user->profile_photo_path == null )
                        <i class="fas fa-user fa-2x"></i>
                    @else
                        <img class="w-full h-full rounded-full object-cover" src={{$user->profile_photo_path}} class="avatarLoaded" alt="avatar">
                    @endif
                </div>
                <div class="mx-auto text-2xl tracking-wider space-y-2">
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
                        <div class="flex flex-col justify-center items-center">
                            <div class="text-center mb-2">USTED NO CUENTA CON TICKETS REGISTRADOS</div>
                            <a href="{{ route('tickets.index') }} mx-auto" class="btn--red">REGISTRAR TICKET</a>
                        </div>
                    @endif
                </div>
            </div> 

            <div class="bg-white text-black w-full max-w-sm rounded-lg border-2 border-yellow py-6 px-8 mt-4">
                <div class="text-black tracking-wider text-center text-4xl">TICKETS</div>
                
                <table class="w-full text-center tracking-wider text-xl mt-4">
                    <thead>
                        <tr>
                            <th><h6># TICKET</h6></th>
                            <th><h6>ESTATUS</h6></th>
                            <th><h6>FECHA</h6></th>
                            <th><h6>PUNTOS</h6></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ( $uploadedTickets &&  count($tickets)>0)
                            @foreach ($tickets as $ticket)
                                <tr>
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
                        @else
                            <tr>
                                <td colspan="4">
                                    <h3>USTED NO CUENTA CON TICKETS REGISTRADOS</h3>
                                    <br>
                                    <div class="actionButton">
                                        <a href="{{route('tickets.index')}}">
                                            <span class="p-0 m-0">REGISTRA TU TICKET</span>
                                        </a>    
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>

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