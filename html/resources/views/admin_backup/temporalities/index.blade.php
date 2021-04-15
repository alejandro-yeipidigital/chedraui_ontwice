@extends('admin.layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Temporalidades') }}</div>
                    <div class="card-body">                 

                        <div class="row">
                            <div class="col-md-3">
                                <a href="{{ route('temporalities.create') }}" class="btn btn-dark">
                                    <i class="fas fa-calendar-plus"></i> Agregar
                                </a>
                            </div>
                        </div>

                        <br>

                        <table class="table table-striped table-sm">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Temporalidad</th>
                                    <th>start at</th>
                                    <th>finish at</th>
                                    <th>
                                        <div align='right'>Acciones</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="tbody">
                                @forelse ($temporalities as $temporality)
                                    <tr>
                                        <td>{{ $temporality->number }}</td>
                                        <td>{{ $temporality->start_at }}</td>
                                        <td>{{ $temporality->finish_at }}</td>
                                        <td align="right">
                                            <a href='{{ route("temporalities.edit", $temporality) }}' class="btn btn-outline-primary btn-sm"><i class="fas fa-pencil-alt"></i></a>

                                            <a href='{{ route("temporalities.changeStatus", $temporality) }}' class="btn btn-outline-{{ ($temporality->status == 1) ? "success" : "secondary" }} btn-sm">
                                                <i class="fas fa-toggle-{{ ($temporality->status == 1) ? "on" : "off" }}"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <td colspan="8" align="center">
                                        <h3>Sin temporalidades</h3>
                                    </td>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script>
        $(function(){
            @if( session('status') )
                alerta('{{ session('status')['status'] }}', '{{ session('status')['message'] }}');
            @endif
        })
    </script>    
@endsection
