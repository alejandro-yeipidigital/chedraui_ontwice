@extends('admin.layouts.layout')

@section('content')
    <div class="be-content">
        <div class="page-head">
            <h2 class="page-head-title">Métricas para Validación de Tickets</h2>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb page-head-nav">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Paises</li>
                    <li class="breadcrumb-item active">Métricas para Validación de Tickets</li>
                </ol>
            </nav>
        </div>

        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-10">
                    <div class="user-info-list card">
                        <div class="card-header card-header-divider" align="center">
                                Métricas Validación Tickets
                        </div>
                        <div class="card-body">
                                <div align="center">
                                    <form action="{{ route('admin.promociones.update-metrics') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="country_id" value="{{ $promotion->id }}">
                                        <textarea name="metrics" cols="150" rows="20" required>
                                            {{ $promotion->ticket_validation_metrics }}
                                        </textarea>
                                        <div class="card-footer" align="center">
                                            <button type="submit" class="btn btn-primary">Actualizar</button>
                                        </div>
                                    </form>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>   
            </div>
        </div>
    </div>
@endsection
