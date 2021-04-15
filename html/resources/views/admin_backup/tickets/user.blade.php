@extends('admin.layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('TICKETS DE USUARIO') }}</div>
                    <div class="card-body">     
                        
                        <div class="row">
                            <div class="col">
                                <a href="{{ url()->previous() }}" class="btn btn-info">Regresar</a>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-striped table-sm" style="box-shadow: 2px 2px 15px rgb(134, 134, 134)">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th colspan="2">
                                                <h2 align='center'>User Info</h2>
                                            </th>
                                        </tr>
                                    </thead>
                                    @foreach ($usuario as $key => $data )
                                        <tr>
                                            <td>{{ $key }}</td>
                                            <td>{{ $data }}</td>
                                        </tr>
                                
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        
                        <br><br>

                        {{ $participations->links() }}

                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>P-ID</th>
                                        <th>Codigo de ticket</th>
                                        <th>Total de puntos</th>
                                        <th>Fecha</th>
                                        <th>Temporalidad</th>
                                        <th>
                                            <div align='right'>Acciones</div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="tbody">
                                    @forelse ($participations as $part)
                                        @if ( $part->validation == 1 )
                                            <tr style="color: blue;">
                                        @elseif( $part->validation == 2 )
                                            <tr  style="color: #479f5b">
                                        @else
                                            <tr  style="color: #f14f4f;">
                                        @endif    
                                            <td>{{ $part->id }}</td>
                                            <td>{{ $part->ticket_code }}</td>
                                            <td align="center">{{ $part->total_points }}</td>
                                            <td>{{ $part->created_at->toDateString() }}</td>
                                            <td align="center">{{ $part->temporality->number }}</td>
                                            <td align='right'>
                                                <a class="btn btn-sm btn-outline-dark" data-toggle="modal" data-target=".modal{{ $part->id }}">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>    
                                    @empty
                                        <tr>
                                            <td>
                                                <h3>No hay tickets para mostrar</h3>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{ $participations->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

{{-- ************************************************************* --}}
{{-- aqui ponemos las modales para poder hacer bien la validación --}}
{{-- ************************************************************ --}}

    @forelse ($participations as $part)
        <div class="modal fade modal{{ $part->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Información de ticket</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped table-sm">
                            <tr>
                                <td>ID</td>
                                <td>{{ $part->id }}</td>
                            </tr>
                            <tr>
                                <td>Temporalidad</td>
                                <td>{{ $part->created_at }}</td>
                            </tr>
                            <tr>
                                <td>Código de ticket</td>
                                <td>{{ $part->ticket_code }}</td>
                            </tr>
                            <tr>
                                <td>Puntos</td>
                                <td>{{ $part->total_points }}</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <img src="{{ $part->ticket }}" alt="" id="img{{ $part->id }}" onerror="standby('img{{ $part->id }}')" width="100%">
                                </td>
                            </tr>
                        </table>
                    </div>
                    @if ( $part->validation == 1 )
                        <div class="modal-footer">
                            <a href="{{ route('tickets.set-approved', $part) }}" class="btn btn-success"><i class="fas fa-check-circle"></i></a>
                            <a  href="{{ route('tickets.set-rejected', $part) }}" class="btn btn-danger"><i class="fas fa-times-circle"></i></a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <tr>
            <td>
                <h3>No hay tickets para mostrar</h3>
            </td>
        </tr>
    @endforelse

    
@endsection


@section('js')
    <script>

        function standby(targetImg) {
            console.log(targetImg);
            document.getElementById(targetImg).src = 'https://thumbs.dreamstime.com/b/no-image-available-icon-flat-vector-no-image-available-icon-flat-vector-illustration-132482953.jpg'
        }

        $(function(){
            @if( session('status') )
                alerta('{{ session('status')['status'] }}', '{{ session('status')['message'] }}');
            @endif
        })
    </script>    
@endsection
