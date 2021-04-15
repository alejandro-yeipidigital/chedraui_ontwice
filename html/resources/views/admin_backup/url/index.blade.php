@extends('admin.layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('URL DEL SITIO') }}</div>
                    <div class="card-body">                 

                        <div class="row justify-content-md-center">
                            <div class="col-6">
                                <form action="{{ route('url.update', $url[0]) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <label for="Chokis">Chokis</label>
                                    <input type="text" name="url" required class="form-control" placeholder="URL del sitio" value="{{ old('url', $url[0]->url) }}">

                                    <br>
                                    <div align='center'>
                                        <button type="submit" class="btn btn-dark">Actualizar</button>
                                    </div>
                                </form>

                                <form action="{{ route('url.update', $url[1]) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <label for="Emperador">Emperador</label>
                                    <input type="text" name="url" required class="form-control" placeholder="URL del sitio" value="{{ old('url', $url[1]->url) }}">

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
