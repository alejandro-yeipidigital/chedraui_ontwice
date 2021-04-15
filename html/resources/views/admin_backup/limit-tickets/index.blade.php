@extends('admin.layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Límite de tickets diarios') }}</div>
                    <div class="card-body">                 

                        <div class="row justify-content-md-center">
                            <div class="col-2">
                                <form action="{{ route('limit-tickets.update', $limit_ticket) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="text" min="1" max="1000" name="total_tickets_by_day" required class="form-control" placeholder="Límite diario" value="{{ old('total_tickets_by_day', $limit_ticket->total_tickets_by_day) }}">

                                    <br>
                                    <div align='center'>
                                        <button type="submit" class="btn btn-dark">Actualizar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
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
