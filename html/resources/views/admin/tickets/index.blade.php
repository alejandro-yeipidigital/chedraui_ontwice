@extends('admin.layouts.layout')

@section('content')
    <div class="be-content">
        <div class="page-head">
            <h2 class="page-head-title">Tickets</h2>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb page-head-nav">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Tickets</li>
                </ol>
            </nav>
        </div>

        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-body">
                            <table class="table table-striped table-hover be-table-responsive" id="table1">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Temporalidad</th>
                                        <th>Usuario</th>
                                        <th>Folio</th>
                                        <th>Fecha Registro</th>
                                        <th>Estatus</th>
                                        <th class="actions">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tickets as $ticket)
                                        <tr>
                                            <td>{{ $ticket->id }}</td>
                                            <td>{{ $ticket->temporality->name }}</td>
                                            <td><a href="{{ route('admin.users.show', $ticket->user_id) }}">{{ $ticket->user->name . ' ' . $ticket->user->middle_name . ' ' . $ticket->user->last_name }}</a></td>
                                            <td>{{ $ticket->ticket_code }}</td>
                                            <td>{{ $ticket->created_at }}</td>
                                            <td>
                                                @if($ticket->validation == 1)
                                                    <span class="text-warning">Pendiente</span> <i class="mdi mdi-alert-triangle text-warning" style="font-size: 18px;"></i>
                                                    @elseif($ticket->validation == 2)
                                                    <span class="text-success">Valido</span> <i class="mdi mdi-check-circle text-success" style="font-size: 18px;"></i>
                                                @else
                                                    <span class="text-danger">Rechazado</span> <i class="mdi mdi-close-circle text-danger" style="font-size: 18px;"></i>
                                                @endif
                                            </td>
                                            <td class="actions">
                                                <a class="btn btn-space btn-primary" href="{{ route('admin.tickets.show', $ticket->id) }}"><i class="mdi mdi-eye"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="mod-delete" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" type="button" data-dismiss="modal" aria-hidden="true"><span class="mdi mdi-close"></span></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <div class="text-danger"><span class="modal-main-icon mdi mdi-alert-triangle"></span></div>
                            <h3>Warning!</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Fusce ultrices euismod lobortis.</p>
                            <div class="mt-8">
                                <button class="btn btn-space btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-space btn-danger" type="button" data-dismiss="modal">Proceed</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer"></div>
                </div>
            </div>
        </div>
@endsection
