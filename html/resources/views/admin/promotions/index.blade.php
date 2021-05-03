@extends('admin.layouts.layout')

@section('content')
    <div class="be-content">
        <div class="page-head">
            <h2 class="page-head-title">Promociones</h2>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb page-head-nav">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Promociones</li>
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
                                        <th>Promoción</th>
                                        <th>Fase de Participación</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $promotions['id'] }}</td>
                                        <td><a href="{{ route('admin.promociones.promocion', ['promotion' => 1]) }}">{{ $promotions['name'] }}</a></td>
                                        <td>{{ $promotions['temporality_name'] }}</td>
                                        <td><a href="{{ route('admin.promociones.promocion', ['promotion' => 1]) }}"><button class="btn btn-primary">Ver</button></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
