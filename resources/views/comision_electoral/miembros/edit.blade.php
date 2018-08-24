@extends('adminlte::page')

@section('title', 'UCABV | Comisión Electoral Miembros')

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
                  <h3 class="box-title">Comisión electoral [{{$id_ce}}] - Miembros</h3>
                </div>
                <div class="box-body">
                <form method="POST" action="{{action('MiembrosCEController@update',$mce[0]->cedula)}}" nctype="multipart/form-data">
                @csrf
                {{ method_field('PATCH') }}
                <input type="hidden" value='{{$id_ce}}' name='id_ce'>
                <label>Cedula</label>
                  <input class="form-control" type="text" placeholder="Cedula" name="cedula" value='{{$mce[0]->cedula}}'>
                  <br>
                  <label>Fecha Inicio</label>
                  <input class="form-control" type="date" placeholder="Fecha Inicio" name="fecha_ini" value='{{$mce[0]->fecha_ini}}'>
                  <br>
                  <label>Fecha Inicio</label>
                  <input class="form-control" type="date" placeholder="Fecha Fin" name="fecha_fin" value='{{$mce[0]->fecha_fin}}'>
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
    