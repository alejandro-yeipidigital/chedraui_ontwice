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
                                        <th>País</th>
                                        <th>Fase de Participación</th>
                                        <th>Activo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($promotions as $promotion)
                                        <tr>
                                            <td>{{ $promotion->id }}</td>
                                            <td><a href="{{ route('admin.promociones.promocion', ['promotion' => $promotion->id]) }}">{{ $promotion->name }}</a></td>
                                            <td>{{ $promotion->country->name }}</td>
                                            <td>{{ $promotion->temporality_name }}</td>
                                            <td>
                                                @if($promotion->active == 1)
                                                    <i class="mdi mdi-check-circle text-success"></i>
                                                @else
                                                    <i class="mdi mdi-close-circle text-danger"></i>
                                                @endif
                                            </td>
                                            <td><a href="{{ route('admin.promociones.promocion', ['promotion' => $promotion->id]) }}"><button class="btn btn-primary">Ver</button></a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
