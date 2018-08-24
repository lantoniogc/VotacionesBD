@extends('adminlte::page')

@section('title', 'UCABV | Cartelera Informativa')

@section('content_header')
    <h1>Cartelera Informativa</h1>
@stop

@section('content')

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-11">
                    <div class="box box-solid">
                      <div class="box-header with-border">
          
                        <h3 class="box-title"><strong>{{$news[0]->titulo}}</strong></h3>
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                    <div class="row">
                        <div class="col-md-5">
                            <img src="{{$news[0]->url_img}}" alt="" class="src" width="400px" height="300px">
                        </div>
                        <div class="col-md-6" style="text-align:justify">
                        <p>{!! $news[0]->body !!}</p>
                        </div>
                    </div>
                      </div>
                      <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                  </div>
                  <!-- ./col -->
        </div>
    </section>
    <!-- /.content -->

@stop

@section('adminlte_js')
    @yield('js')
@stop
