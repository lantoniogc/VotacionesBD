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
                <form method="POST" action="{{action('EscuelasController@update',$escuelas[0]->code_escuela)}}" nctype="multipart/form-data">
                @csrf
                {{ method_field('PATCH') }}
                <label>Nombre</label>
                  <input class="form-control" type="text" placeholder="Nombre" name="nombre" value='{{$escuelas[0]->nombre}}'>
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
    