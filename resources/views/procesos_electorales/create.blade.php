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
                <form method="POST" action="{{url('admin/procesos_electorales')}}" enctype="multipart/form-data">
                @csrf
                <label>Periodo</label>
                  <input class="form-control" type="text" placeholder="Periodo" name="periodo">
                  <br>
                <label>Estatus</label>
                  <input class="form-control" type="text" placeholder="Estatus" name="status">
                  <br>
                  <label>Fecha de Postulación [Inicio]</label>
                  <input class="form-control" type="date" placeholder="Fecha Inicio Postulacion" name="fecha_inicio_postulacion">
                  <br>
                  <label>Fecha de Postulación [Fin]</label>
                  <input class="form-control" type="date" placeholder="Fecha Fin Postulacion" name="fecha_fin_postulacion">
                  <br>
                  <label>Fecha de Votación</label>
                  <input class="form-control" type="date" placeholder="Fecha votacion" name="fecha_votacion">
                  <br>
                  <button type="submit" class="btn btn-success pull-right">Crear</button>
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
    