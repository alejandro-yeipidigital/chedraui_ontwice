@extends('admin.layouts.layout')

@section('content')
<div class="be-wrapper be-login">
    <div class="be-content">
        <div class="main-content container-fluid">
            <div class="splash-container">
                <div class="card card-border-color card-border-color-danger">
                    <div class="card-header">
                        <img class="logo-img" src="{{ asset('assets_admin/img/logo-xx.png') }}" alt="logo" width="220">
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="{{ route($loginRoute) }}">
                            @csrf

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
                                @error('email')
                                    <ul class="parsley-errors-list filled" id="parsley-id-5">
                                        <li class="parsley-required">{{ $message }}</li>
                                    </ul>
                                @enderror
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input id="password" type="password" class="form-control" name="password" placeholder="Contraseña" required>
                                @error('password')
                                    <ul class="parsley-errors-list filled" id="parsley-id-5">
                                        <li class="parsley-required">{{ $message }}</li>
                                    </ul>
                                @enderror
                            </div>

                            <div class="form-group row login-tools">
                                <div class="col-6 login-remember">
                                    <label class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <span class="custom-control-label">Recordarme</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group login-submit">
                                <button type="submit" class="btn btn-danger btn-xl">Iniciar Sesión</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



