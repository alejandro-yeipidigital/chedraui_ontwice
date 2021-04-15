@extends('admin.layouts.layout')

@section('content')
    <div class="be-content">
        <div class="page-head">
            <h2 class="page-head-title">Descargar Tickets Válidos</h2>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb page-head-nav">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Descargar Tickets Válidos</li>
                </ol>
            </nav>
        </div>

        <div class="main-content container-fluid">
            <div class="col-sm-12">
                @if (\Session::has('fail'))
                    <div class="col col-12">
                        <div class="alert alert-warning">
                            <ul>
                                <li>{!! \Session::get('fail') !!}</li>
                            </ul>
                        </div>                        
                    </div>
                @endif
                <div class="row">
                    <div class="col-sm-3" style="background-color: #FFF;">
                        <h4>Exportar a CSV: </h4>
                        <form action="{{ route('admin.tickets.export') }}" method="POST">
                            @csrf
                            <select name="semana_id" id="semana_id">
                                @foreach ($temporalities as $temporality)
                                    <option value="{{ $temporality->id }}">{{ $temporality->name }}</option>
                                @endforeach
                            </select>
                            <br><br>                            
                            <button type="submit" class="btn btn-primary" style="margin-bottom: 20px;">Exportar</button>
                        </form>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-body">
                            <table class="table table-striped table-hover be-table-responsive" id="table1">
                                <thead>
                                    <tr>
                                        <th>Semana</th>
                                        <th>Usuario</th>
                                        <th>Fecha Compra</th>
                                        <th>Fecha Registro</th>
                                        <th>Tienda</th>
                                        <th>Total</th>
                                        <th>Puntos</th>
                                        <th class="actions">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tickets as $ticket)
                                        <tr>
                                            <th>{{ $ticket->temporality->name.'.' }}</th>
                                            <th><a href="{{ url('/admin/usuarios/' . $ticket->user->id) }}">{{ $ticket->user->full_name }}</a></th>
                                            <th>{{ $ticket->ticket_date }}</th>
                                            <th>{{ $ticket->created_at }}</th>
                                            <th>{{ $ticket->store_id }}</th>
                                            <th>{{ $ticket->total }}</th>
                                            <th>{{ $ticket->points }}</th>
                                            <th><a href="{{ url('/admin/tickets/' . $ticket->id) }}"><button type="button" class="btn btn-primary">Ver Ticket</button></a></th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
