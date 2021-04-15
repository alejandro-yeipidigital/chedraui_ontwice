@extends('admin.layouts.layout')
@section('content')
    <div class="be-content">
        <div class="main-content container-fluid">

        	<h3 class="text-center" style="margin-bottom: 30px;">Hola, {{ Auth::guard('admin')->user()->name . ' ' .  Auth::guard('admin')->user()->last_name}} Bienvenido</h3>

            @can('seeDashboard', \App\Models\Admin::class)
                <div class="col col-12">
                    <dashboard-component :data="{{ $response }}"></dashboard-component>
                </div>
            @endcan
        </div>
    </div>
</div>
@endsection