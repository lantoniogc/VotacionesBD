@extends('adminlte::page')

@section('title', 'UCABV | Cargos por Escuelas')

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
                  <h3 class="box-title">Cargos por escuela</h3>
                </div>
                <div class="box-body">
                <form method="POST" action="{{url('admin/cargos-por-escuelas')}}" enctype="multipart/form-data">
                @csrf
                <label>Periodo activo</label>
                <input class="form-control" type="text" placeholder="Periodo" name="periodo" value='{{$periodoActivo[0]->periodo}}' disabled>
                <br>
                <label>Escuelas</label>
                <div class="form-group">
                <select name="code_escuela" class="form-control">
                    @foreach ($escuelas as $item)
                        <option value="{{$item->code_escuela}}">{{$item->nombre}}</option>
                    @endforeach
                </select>
                </div>
                <label>Cargos</label>
                <div class="form-group">
                <select name="code_cargo" class="form-control">
                    @foreach ($cargos as $item)
                        <option value="{{$item->code_cargo}}">{{$item->nombre}}</option>
                    @endforeach
                </select>
                </div>                  
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
    