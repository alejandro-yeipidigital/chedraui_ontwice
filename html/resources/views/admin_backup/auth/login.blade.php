@extends('admin.layouts.main')

@section('content')
<div class="col-4 offset-4">
    <div class="be-wrapper be-login">
        <div class="be-content">
            <div class="main-content container-fluid">
                <div class="splash-container">
                    <div class="card card-border-color card-border-color-primary">
                        <div class="card-header">
                            CMS | Poder & Chispa
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" method="POST" action="{{ route('admin.login') }}">
                                @csrf

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
                                    @if ($errors->has('email'))
                                        <ul class="parsley-errors-list filled" id="parsley-id-5">
                                            <li class="parsley-required">{{ $errors->first('email') }}</li>
                                        </ul>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <input id="password" type="password" class="form-control" name="password" placeholder="Contraseña" required>
                                    @if ($errors->has('password'))
                                        <ul class="parsley-errors-list filled" id="parsley-id-5">
                                            <li class="parsley-required">{{ $errors->first('password') }}</li>
                                        </ul>
                                    @endif
                                </div>

                                <div class="form-group row login-tools">
                                    <div class="col-6 login-remember">
                                        <label class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <span class="custom-control-label">Recordarme</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group login-submit">
                                    <button type="submit" class="btn btn-primary btn-xl">Iniciar Sesión</button>
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



