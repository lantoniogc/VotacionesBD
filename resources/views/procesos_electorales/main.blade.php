@extends('adminlte::page')

@section('title', 'UCABV | Procesos Electorales')

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
                          <a href="{{ URL::to('admin/procesos_electorales/create') }}"><button class="btn btn-success"><i class="fa  fa-plus"></i>Nuevo</button></a>
            
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
                              <th>Periodo</th>
                              <th>Estatus</th>
                              <th>Fecha de Postulación [Inicio]</th>
                              <th>Fecha de Postulación [Fin]</th>
                              <th>Fecha de Votacion</th>
                            </tr>
                            @foreach ($procesos_electorales as $item)
                            <tr>
                              <td>{{$item->periodo}}</td>
                              <td>{{$item->status}}</td>
                              <td>{{$item->fecha_inicio_postulacion}}</td>
                              <td>{{$item->fecha_fin_postulacion}}</td>
                              <td>{{$item->fecha_votacion}}</td>
                              <td>
                              <a href="{{url('admin/procesos_electorales/'.$item->periodo.'/edit')}}"><button class="btn btn-info"><i class="fa  fa-pencil"></i>Editar</button></a>
                              <form style="display:inline" method="POST" action="{{action('Procesos_ElectoralesController@destroy',$item->periodo)}}" nctype="multipart/form-data">
                                @csrf
                                {{ method_field('DELETE') }} 
                                <button class="btn btn-danger"><i class="fa  fa-trash-o"></i>Borrar</button>
                              </form>  
                              </td>
                            </tr>
                            @endforeach
                          </table>
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
