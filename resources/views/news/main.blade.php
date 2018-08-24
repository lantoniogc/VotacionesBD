@extends('adminlte::page')

@section('title', 'UCABV | Cartelera Informativa')

@section('content_header')
    <h1>Panel de Administracion</h1>
@stop

@section('content')
    <!-- Main content -->
    <section class="content container-fluid">
        
            <div class="row">
                    <div class="col-xs-12">
                      <div class="box">
                        <div class="box-header">
                          <a href="{{ URL::to('admin/news/create') }}"><button class="btn btn-success"><i class="fa  fa-plus"></i>Nuevo</button></a>
            
                          <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                              <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
            
                              <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                          <table class="table table-hover">
                            <tr>
                              <th>ID</th>
                              <th>Titulo</th>
                              <th>Descripcion</th>
                              <th>URL IMG</th>
                              <th>Accion</th>
                            </tr>
                            @foreach ($news as $item)
                            <tr>
                              <td>{{$item->idart}}</td>
                              <td>{{$item->titulo}}</td>
                              <td>{{$item->descripcion}}</td>
                              <td>{{$item->url_img}}</td>
                              <td><button class="btn btn-success"><i class="fa  fa-eye"></i>Ver</button>
                              <a href="{{url('admin/news/'.$item->idart.'/edit')}}"><button class="btn btn-info"><i class="fa  fa-pencil"></i>Editar</button></a>
                              <form style="display:inline" method="POST" action="{{action('CarteleraController@destroy',$item->idart)}}" nctype="multipart/form-data">
                                @csrf
                                {{ method_field('DELETE') }} 
                                <button class="btn btn-danger"><i class="fa  fa-trash-o"></i>Borrar</button>
                              </form>  
                              </td>
                            </tr>
                            @endforeach
                          </table>

                          <div class="pag-sty"> {{ $news->fragment('news')->render() }} </div>
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
