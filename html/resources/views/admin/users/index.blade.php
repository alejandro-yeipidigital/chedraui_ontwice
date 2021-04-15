@extends('admin.layouts.layout')

@section('content')
    <div class="be-content">
        <div class="page-head">
            <h2 class="page-head-title">Usuarios</h2>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb page-head-nav">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Usuarios</li>
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
                                        <th>Avatar</th>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Fecha de Registro</th>
                                        <th>Activo</th>
                                        <th class="actions">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td class="user-avatar">
                                                <img src="{{ asset($user->avatar ? $user->avatar : 'assets_admin/img/avatar7.png') }}" alt="Avatar">
                                            </td>
                                            <td><a href="{{ route('admin.users.show', $user->id) }}">{{ $user->name . ' ' . $user->middle_name . ' ' . $user->last_name}}</a></td>
                                            <td><a href="{{ route('admin.users.show', $user->id) }}">{{ $user->email }}</a></td>
                                            <td>{{ $user->created_at }}</td>
                                            <td style="font-size: 22px;">
                                                @if($user->active)
                                                    <i class="mdi mdi-check-circle text-success"></i>
                                                @else
                                                    <i class="mdi mdi-close-circle text-danger"></i>
                                                @endif
                                            </td>
                                            <td class="actions">
                                                <a class="btn btn-space btn-primary" href="{{ route('admin.users.show', $user->id) }}"><i class="mdi mdi-edit"></i></a>
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

        <div class="modal fade" id="mod-delete" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" type="button" data-dismiss="modal" aria-hidden="true"><span class="mdi mdi-close"></span></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <div class="text-danger"><span class="modal-main-icon mdi mdi-alert-triangle"></span></div>
                            <h3>Warning!</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Fusce ultrices euismod lobortis.</p>
                            <div class="mt-8">
                                <button class="btn btn-space btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-space btn-danger" type="button" data-dismiss="modal">Proceed</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer"></div>
                </div>
            </div>
        </div>

@endsection
