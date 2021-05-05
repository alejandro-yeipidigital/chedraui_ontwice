@extends('admin.layouts.layout')

@section('content')

    <div class="be-content">
        <div class="main-content container-fluid">
            <div class="user-profile">
                <div class="row">
                    @if (\Session::has('fail'))
                        <div class="col col-12">
                            <div class="alert alert-warning">
                                <ul>
                                    <li>{!! \Session::get('fail') !!}</li>
                                </ul>
                            </div>                        
                        </div>
                    @endif
                    <div class="col-12" style="margin-top: 60px;">
                        <div class="row">
                            <div class="col col-12 col-md-12 col-lg-4">
                                <div class="user-display">
                                    <div class="user-display-bottom">
                                        <div class="user-display-avatar"><img src="{{ asset( $user->avatar ?  $user->avatar : 'assets_admin/img/avatar7.png') }}" alt="Avatar"></div>
                                        <div class="user-display-info">
                                            <div class="name">
                                                {{ $user->full_name }}

                                                @if($user->blocked == 0)
                                                    <i class="mdi mdi-check-circle text-success"></i>
                                                @else
                                                    <i class="mdi mdi-close-circle text-danger"></i>
                                                    <p style="color: red;"> - El usuario ha sido bloqueado</p>
                                                @endif
                                            </div>
                                            <div class="nick"><br></div>
                                        </div>
                                        <div class="row user-display-details">
                                            <div class="col-3">
                                                <div class="title">Tickets Registrados</div>
                                                <div class="counter">{{ $user->participations->count() }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row col-12 col-md-12 col-lg-8">
                                <div class="col-12 col-md-4">
                                    <div class="user-info-list card">
                                        <div class="card-header card-header-divider">
                                        @if ($user->active == 0)
                                            Desbloquear usuario
                                        @else
                                            Bloquear usuario
                                        @endif
                                            
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ route('admin.users.block') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{$user->id}}">
                                                <div align="center">
                                                    <button class="btn btn-warning" onclick="return confirm('¿Estás seguro?')">Confirmar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-12 col-md-4">
                                    <div class="user-info-list card">
                                        <div class="card-header card-header-divider">
                                            Eliminar Usuario
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ secure_url('/admin/usuarios/delete') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="wa_id" value="{{ $user->id }}">
                                                <div align="center">
                                                    <button class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este usuario y todos sus registros?')">Eliminar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="user-info-list card">
                                    <div class="card-header card-header-divider">
                                        Observaciones del Usuario
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('admin.users.observations') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{$user->id}}">
                                            <textarea name="observations" cols="30" rows="5" style="width: 100%;">{{ $user->observations }}</textarea>
                                            <div align="right">
                                                <button class="btn btn-primary">Guardar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="user-info-list card">
                                    <div class="card-header card-header-divider">Puntos Acumulados por Fase</div>
                                    <div class="card-body">
                                        <div class="row user-display-details">
                                            {{-- @foreach ($temporalities_points as $temporality_points)
                                                <div class="col-4 col-md-2 col-lg-1">
                                                    <div class="title">{{ $temporality_points->name }}</div>
                                                    <div class="counter">{{ $temporality_points->points }}</div>
                                                </div>
                                            @endforeach --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            
                        <div class="row">
                            <div class="col-12 table table-responsive">
                                <div class="user-info-list card">
                                    <div class="card-header card-header-divider">Información</div>
                                    <div class="card-body">
                                        <table class="table no-border no-strip skills">
                                            <tbody class="no-border-x no-border-y">
                                                <tr>
                                                    <td class="icon"><span class="mdi mdi-case"></span></td>
                                                    <td class="item">User Id<span class="icon s7-portfolio"></span></td>
                                                    <td>{{ $user->id }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="icon"><span class="mdi mdi-email"></span></td>
                                                    <td class="item">Email<span class="icon s7-portfolio"></span></td>
                                                    <td>{{ $user->email }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="icon"><span class="mdi mdi-smartphone-android"></span></td>
                                                    <td class="item">Teléfono de Contacto<span class="icon s7-phone"></span></td>
                                                    <td>{{ $user->telephone }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($user->participations->count() > 0)
                        <div class="col-12">
                            <div class="widget widget-fullwidth widget-small">
                                <div class="widget-head pb-12">
                                    <div class="title">Tickets Registrados</div>
                                </div>
                                <div class="widget-chart-container col-12 table-responsive">
                                    <table class="col-12 table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Ticket Id</th>
                                                <th>Fase de Participación</th>
                                                <th>Fecha Registro</th>
                                                <th>Verificación</th>
                                                <th>Valido</th>
                                                <th class="actions">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($user->participations as $key => $ticket)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $ticket->id }}</td>
                                                        <td>{{ $ticket->temporality->name }}</td>
                                                        <td>{{ $ticket->created_at }}</td>
                                                        <td>
                                                            @if ($ticket->validation == 1)
                                                                <p>Pendiente</p>
                                                            @elseif ($ticket->validation == 2)
                                                                <p>Revisado</p>
                                                            @else
                                                                <p>Rechazado</p>
                                                            @endif
                                                        </td>
                                                        <td style="font-size: 22px;">
                                                            @if ($ticket->validation == 1)
                                                                <i class="mdi mdi-alert-circle text-warning"></i>
                                                            @elseif ($ticket->validation == 2)
                                                                <i class="mdi mdi-check-circle text-success"></i>
                                                            @elseif ($ticket->validation == 3)
                                                                <i class="mdi mdi-close-circle text-danger"></i>
                                                            @endif
                                                        </td>
                                                        <td class="actions">
                                                            <a class="btn btn-space btn-primary" href="{{ route('admin.tickets.show', $ticket->id) }}"><i class="mdi mdi-edit"></i></a>
                                                        </td>
                                                    </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection