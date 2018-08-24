@extends('adminlte::page')

@section('title', 'UCABV | Perfil')

@section('content_header')
    <h1>Perfil</h1>
@stop

@section('content')

<div class="row">
    <div class="col-md-8" style="margin: 0 17%;">

      <!-- Profile Image -->
      <div class="box box-primary">
        <div class="box-body box-profile">
          <img class="profile-user-img img-responsive img-circle" src="img/testvota.png" alt="User profile picture">
          <br>

          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <b>Nombre(s)</b> <p class="pull-right">{{Auth::user()->nombres}}</p>
            </li>
            <li class="list-group-item">
              <b>Apellido(s)</b> <p class="pull-right">{{Auth::user()->apellidos}}</p>
            </li>
            <li class="list-group-item">
              <b>Correo Electronico</b> <a class="pull-right">{{Auth::user()->email}}</a>
            </li>
          </ul>

          <a href="#" class="btn btn-primary btn-block" onclick="location.href='admin-modificarPerfil.php'"><b>Modificar Perfil</b></a>
        </div><!-- /.box-body -->
      </div><!-- /.box -->

      <!-- About Me Box -->
      <div class="box box-primary" style="text-align: center">
        <div class="box-header with-border">
          <h3 class="box-title">Acerca de mi</h3>
        </div><!-- /.box-header -->
        <div class="box-body">

          <strong><i class="fa fa-phone margin-r-5"></i> Teléfono</strong>
          <p>{{Auth::user()->telefono_principal}}</p>

          <hr>

          @if(Auth::user()->tipo == 'Profesor')

          <?php
          $profesorData = \DB::table('profesores')->where('cedula','=',Auth::user()->cedula)->get();
          ?>

          <strong><i class="fa fa-map-marker margin-r-5"></i>  Escalafon</strong>
          <p class="text-muted">
            {{$profesorData[0]->escalafon}}
          </p>

          <hr>

          <strong><i class="fa fa-calendar-alt margin-r-5"></i> Fecha de ingreso</strong>
          <p class="text-muted">{{$profesorData[0]->fecha_ingreso}}</p>

          @endif


          @if(Auth::user()->tipo == 'Egresado')

          <?php
          $egresadoData = \DB::table('egresados')->where('cedula','=',Auth::user()->cedula)->get();
          ?>

          <strong><i class="fa fa-map-marker margin-r-5"></i>  Ubicación</strong>
          <p class="text-muted">
            {{$egresadoData[0]->ubicacion}}
          </p>

          <hr>

          <strong><i class="fa fa-calendar-alt margin-r-5"></i> Fecha de egreso</strong>
          <p class="text-muted">{{$egresadoData[0]->fecha_egreso}}</p>

          @endif
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->

@stop