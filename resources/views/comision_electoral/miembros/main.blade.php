@extends('adminlte::page')

@section('title', 'UCABV | Comisión Electoral Miembros')

@section('content_header')
    <h1>Panel de Administracion - Comisión Electoral {{$id_ce}}</h1>
@stop

@section('content')
    <!-- Main content -->
    <section class="content container-fluid">
        
            <div class="row">
                    <div class="col-xs-12">
                      <div class="box">
                        <div class="box-header">
                          <a href="{{ URL::to('admin/comision_electoral/'.$id_ce.'/miembros/create') }}"><button class="btn btn-success"><i class="fa  fa-plus"></i>Nuevo</button></a>
            
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
                              <th>ID_CE</th>
                              <th>Cedula</th>
                              <th>Fecha Inicio</th>
                              <th>Fecha Fin</th>
                            </tr>
                            @foreach ($mce as $item)
                            <tr>
                              <td>{{$item->id_ce}}</td>
                              <td>{{$item->cedula}}</td>
                              <td>{{$item->fecha_ini}}</td>
                              <td>{{$item->fecha_fin}}</td>
                              <td>
                              <a href="{{url('admin/comision_electoral/'.$id_ce.'/miembros/'.$item->cedula.'/edit')}}"><button class="btn btn-info"><i class="fa  fa-pencil"></i>Editar</button></a>
                              <form style="display:inline" method="POST" action="{{action('MiembrosCEController@destroy',$item->cedula)}}" nctype="multipart/form-data">
                                @csrf
                                {{ method_field('DELETE') }} 
                                <button class="btn btn-danger"><i class="fa  fa-trash-o"></i>Borrar</button>
                              </form>  
                              </td>
                            </tr>
                            @endforeach
                          </table>

                          <div class="pag-sty"> {{ $mce->fragment('mce')->render() }} </div>
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
