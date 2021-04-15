@extends('admin.layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">                 
                        <div class="row justify-content-md-center">
                            <div class="col-12 text-center">
                                <h1>Hola {{ Auth::user()->name }}, Bienvenido</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection