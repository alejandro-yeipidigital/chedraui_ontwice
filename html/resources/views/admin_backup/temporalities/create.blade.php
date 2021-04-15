@extends('admin.layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Temporalidades') }}</div>
                    <div class="card-body">                 

                        <div class="row justify-content-md-center">
                            <div class="col-md-8">
                                <form action="{{ route("temporalities.store") }}" method="POST">
                                    @csrf
                                    @include('admin.temporalities._form', ['btn' => 'Guardar'])
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

