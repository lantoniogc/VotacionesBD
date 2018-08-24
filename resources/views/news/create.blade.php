@extends('adminlte::page')

@section('title', 'UCABV | Cartelera Informativa')

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
                  <h3 class="box-title">Noticias</h3>
                </div>
                <div class="box-body">
                <form method="POST" action="{{url('admin/news')}}" enctype="multipart/form-data">
                @csrf
                <label>Titulo</label>
                  <input class="form-control" type="text" placeholder="Titulo" name="titulo">
                  <br>
                  <label>URL Image</label>
                  <input class="form-control" type="text" placeholder="https://..." name="url_img">
                  <br>
                  <label>Descripcion</label>
                  <textarea class="form-control" rows="3" placeholder="Enter ..." style="resize: none" name="descripcion"></textarea>
                  <br>
                  <label>Cuerpo de la noticia</label>
                  <textarea class="form-control" id="body" placeholder="Place some text here" name="body"></textarea>
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
    