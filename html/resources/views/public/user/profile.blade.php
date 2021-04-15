@extends('layouts.app')


@section('content')

    <div class="profileContainer">
        <div class="profileBanner">
            <div class="profileSection">

                <div class="row col-12 p-0 m-0 text-center justify-content-center">
                    <div class="generalSectionsTitle">
                        <img src="{{asset('images/profile/Logo_Profile.png')}}" alt="Logo_Registro">
                    </div>
                    
                    <div class="profileContent generalSectionsContain">
                        <div class="profileContentCards">
                            <div class="profileContentInfo">
                                <div class="profileContentAvatar bg-white">
                                    @if ( $userAvatar == null )
                                        <i class="fas fa-user fa-2x text-blueSaladitas"></i>
                                    @else
                                        <img src={{$userAvatar}} class="avatarLoaded" alt="avatar">
                                    @endif
                                </div>
                                <div class="profileContentName">
                                    <h3> {{ $name }} </h3>
                                </div>
                                @if ($actualTemporality != 0)
                                    <div class="pt-3">
                                        <h3>FASE {{ $actualTemporality }}</h3>
                                    </div>
                                @endif

                                <div class="profileContentDetails">
                                    @if ($uploadedTickets)
                                        <div class="profileContentDetailLevel">
                                            <h6>POSICIÓN</h6>
                                            <h3>{{ $user_position }}</h3>
                                        </div>
                                        <div class="profileContentDetailPoints">
                                            <h6>PTS ACUMULADOS</h6>
                                            <h3>{{ $user_points->validated_points }}</h3>
                                        </div>
                                        <div class="profileContentDetailExchanged">
                                            <h6>TICKETS REGISTRADOS</h6>
                                            <h3>{{ $tickets_validated }}</h3>
                                        </div>
                                    @else
                                        <h3>USTED NO CUENTA CON TICKETS REGISTRADOS</h3>
                                        <br>
                                        <div class="actionButton">
                                            <a href="{{route('tickets.index')}}">
                                                <span class="p-0 m-0">REGISTRA TU TICKET</span>
                                            </a>    
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <br><br>
                            <div class="profileContentTickets">
                                <div class="profileContentTicketTitle">
                                    <h3>TICKETS</h3>
                                </div>
                                <div class="profileContentTable">
                                    <table>
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
                        </div>
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