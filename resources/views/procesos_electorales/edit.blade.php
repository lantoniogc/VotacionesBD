@extends('adminlte::page')

@section('title', 'UCABV | Procesos Electorales')

@section('content_header')
    <h1>Panel de Administracion</h1>
@stop

@section('content')

<!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
        <div class="col-md-8">
        <!-- Form Element sizes -->
          <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Procesos Electorales</h3>
                </div>
                <div class="box-body">
                  @if(Session::has('errorMsg'))
                    <div class="alert alert-danger">{{ Session::get('errorMsg') }}</div>
                  @endif                  
                <form method="POST" action="{{action('Procesos_ElectoralesController@update',$procesos_electorales[0]->periodo)}}" nctype="multipart/form-data">
                @csrf
                {{ method_field('PATCH') }}
                <label>Periodo</label>
                  <input class="form-control" type="text" placeholder="Periodo" name="periodo" value='{{$procesos_electorales[0]->periodo}}'>
                  <br>
                <label>Estatus</label>
                  <input class="form-control" type="text" placeholder="Estatus" name="status" value='{{$procesos_electorales[0]->status}}'>
                  <br>
                  <label>Fecha de Postulación [Inicio]</label>
                  <input class="form-control" type="date" placeholder="Fecha de Inicio de Postulacion" name="fecha_inicio_postulacion" value='{{$procesos_electorales[0]->fecha_inicio_postulacion}}'>
                  <br>
                  <label>Fecha de Postulación [Fin]</label>
                  <input class="form-control" type="date" placeholder="Fecha de Fin de Postulacion" name="fecha_fin_postulacion" value='{{$procesos_electorales[0]->fecha_fin_postulacion}}'>
                  <br>
                  <label>Fecha de Votacion</label>
                  <input class="form-control" type="date" placeholder="Fecha Votacion" name="fecha_votacion" value='{{$procesos_electorales[0]->fecha_votacion}}'>
                  <br>
                  <button type="submit" class="btn btn-success pull-right">Editar</button>
                  </form>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->

@stop

@section('adminlte_js')
    @yield('js')
@stop
    