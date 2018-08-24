@extends('adminlte::page')

@section('title', 'UCABV | Escuelas')

@section('content_header')
    <h1>Cartelera Informativa (ADMIN)</h1>
@stop

@section('content')

<!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
        <div class="col-md-8">
        <!-- Form Element sizes -->
          <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Escuelas</h3>
                </div>
                <div class="box-body">
                <form method="POST" action="{{url('admin/escuelas')}}" enctype="multipart/form-data">
                @csrf
                <label>Nombre</label>
                  <input class="form-control" type="text" placeholder="Nombre" name="nombre">
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
    