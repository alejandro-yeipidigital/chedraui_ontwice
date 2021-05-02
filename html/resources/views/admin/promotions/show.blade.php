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
                <promotion-component 
                    :data="{{ $response }}" 
                    :promotion="{{ json_encode($promotion) }}"></promotion-component>
            
                <div class="col col-12">
                    <div class="card-head"><h2>Temporalidades</h2></div>
                    <div class="card card-table">
                        <div class="card-body">
                            <table class="table table-striped table-hover be-table-responsive" id="table1">
                                <thead>
                                    <th></th>
                                    <th>Fase</th>
                                    <th>Inicio</th>
                                    <th>Fin</th>
                                    <th>Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach ($temporalities as $key => $temporality)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $temporality->name }}</td>
                                            <td>{{ $temporality->start }}</td>
                                            <td>{{ $temporality->end }}</td>
                                            <td style="display: flex; flex-direction: row;">
                                                <a href="{{ secure_url('/admin/promociones/ranking/' . $temporality->id) }}" style="margin-right: 10px;"><button class="btn btn-success">Ver Ranking</button></a>
                                                <form action="{{ route('admin.promociones.download-ranking') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="temporality_id" value="{{ $temporality->id }}">
                                                    <button type="submit" class="btn btn-primary">Descargar Ranking</button>
                                                </form>
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
    </div>
@endsection
