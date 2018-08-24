@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
    @yield('css')
@stop

@section('body_class', 'register-page')

@section('body')
    <div class="register-box">
        <div class="register-logo">
            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</a>
        </div>

        <div class="register-box-body">
            <p class="login-box-msg">{{ trans('adminlte::adminlte.register_message') }}</p>
            <form action="{{ url(config('adminlte.register_url', 'register')) }}" method="post">
                {!! csrf_field() !!}
                <div class="row">
                <div class="col-md-6">
                <div class="form-group has-feedback {{ $errors->has('cedula') ? 'has-error' : '' }}">
                    <input type="text" name="cedula" class="form-control" value="{{ old('cedula') }}"
                           placeholder="Cedula de identidad">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    @if ($errors->has('cedula'))
                        <span class="help-block">
                            <strong>{{ $errors->first('cedula') }}</strong>
                        </span>
                    @endif
                </div>
              
                <div class="form-group has-feedback {{ $errors->has('nombres') ? 'has-error' : '' }}">
                    <input type="text" name="nombres" class="form-control" value="{{ old('nombres') }}"
                           placeholder="Nombres">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    @if ($errors->has('nombres'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nombres') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('apellidos') ? 'has-error' : '' }}">
                    <input type="text" name="apellidos" class="form-control" value="{{ old('apellidos') }}"
                           placeholder="Apellidos">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    @if ($errors->has('apellidos'))
                        <span class="help-block">
                            <strong>{{ $errors->first('apellidos') }}</strong>
                        </span>
                    @endif
                </div>     

                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                           placeholder="{{ trans('adminlte::adminlte.email') }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('email_alternativo') ? 'has-error' : '' }}">
                        <input type="email" name="email_alternativo" class="form-control" value="{{ old('email_alternativo') }}"
                               placeholder="Email alternativo">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email_alternativo') }}</strong>
                            </span>
                        @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('direccion') ? 'has-error' : '' }}">
                        <input type="text" name="direccion" class="form-control" value="{{ old('direccion') }}"
                               placeholder="Dirección">
                        <span class="glyphicon glyphicon-home form-control-feedback"></span>
                        @if ($errors->has('direccion'))
                            <span class="help-block">
                                <strong>{{ $errors->first('direccion') }}</strong>
                            </span>
                        @endif
                </div>   

                <div class="form-group has-feedback {{ $errors->has('telefono_principal') ? 'has-error' : '' }}">
                        <input type="text" name="telefono_principal" class="form-control" value="{{ old('telefono_principal') }}"
                               placeholder="Telefono principal">
                        <span class="glyphicon glyphicon-earphone form-control-feedback"></span>
                        @if ($errors->has('telefono_principal'))
                            <span class="help-block">
                                <strong>{{ $errors->first('telefono_principal') }}</strong>
                            </span>
                        @endif
                </div>                    

                <div class="form-group has-feedback {{ $errors->has('telefono_alternativo') ? 'has-error' : '' }}">
                        <input type="text" name="telefono_alternativo" class="form-control" value="{{ old('telefono_alternativo') }}"
                               placeholder="Telefono alternativo">
                        <span class="glyphicon glyphicon-earphone form-control-feedback"></span>
                        @if ($errors->has('telefono_alternativo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('telefono_alternativo') }}</strong>
                            </span>
                        @endif
                </div>      

            </div>
            <div class="col-md-6">

                    <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                            <input type="password" name="password" class="form-control"
                                   placeholder="{{ trans('adminlte::adminlte.password') }}">
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                            <input type="password" name="password_confirmation" class="form-control"
                                   placeholder="{{ trans('adminlte::adminlte.retype_password') }}">
                            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group has-feedback {{ $errors->has('tipo') ? 'has-error' : '' }}">
                            <input type="text" name="tipo" class="form-control" value="{{ old('tipo') }}"
                                   placeholder="Tipo">
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                            @if ($errors->has('nombres'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tipo') }}</strong>
                                </span>
                            @endif
                        </div>
        
                        @yield('content')

                        <div class="form-group has-feedback {{ $errors->has('sexo') ? 'has-error' : '' }}">
                                <div class="form-check form-check-inline">
                                    <label for="sexo" class="col-md-4 control-label">Sexo</label>
                                    <input name="sexo" class="form-check-input" type="radio" id="sexo" value="Masculino">
                                    <label class="form-check-label" for="inlineCheckbox1">M</label>
                                    <input name="sexo" class="form-check-input" type="radio" id="sexo" value="Femenino">
                                    <label class="form-check-label" for="inlineCheckbox2">F</label>
                                  </div>
                            </div>  

                {{-- roles options --}}
                        <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Rol</label>

                            <div class="col-md-6">
                                <select id="name" type="text" class="form-control" name="role" value="{{ old('role') }}" required >
                                    @foreach($roles as $id=>$role)
                                        <option value="{{$id}}">{{$role}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('role'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>   

                <button type="submit"
                        class="btn btn-primary btn-block btn-flat"
                >{{ trans('adminlte::adminlte.register') }}</button>
                    
            </form>
            <div class="auth-links">
                <a href="{{ url(config('adminlte.login_url', 'login')) }}"
                   class="text-center">{{ trans('adminlte::adminlte.i_already_have_a_membership') }}</a>
            </div>       
            </div>
            </div>
        </div>
        <!-- /.form-box -->
@stop

@section('adminlte_js')
    @yield('js')
@stop
