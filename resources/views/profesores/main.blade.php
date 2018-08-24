@extends('adminlte::page')

@section('title', 'UCABV | Profesores')

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
                          <a href="{{ URL::to('admin/profesores/create') }}"><button class="btn btn-success"><i class="fa  fa-plus"></i>Nuevo</button></a>
            
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
                              <th>Cedula</th>
                              <th>Nombre</th>
                              <th>Apellido</th>
                              <th>Email_Principal</th>
                              <th>Escalafon</th>
                              <th>Escuela</th>
                            </tr>
                            @foreach ($profesores as $item)
                            <?php
                            $escuelas = \DB::table('escuelas')->where('code_escuela','=',$item->code_escuela)->get();
                            ?>
                            <tr>
                              <td>{{$item->cedula}}</td>
                              <td>{{$item->nombres}}</td>
                              <td>{{$item->apellidos}}</td>
                              <td>{{$item->email}}</td>
                              <td>{{$item->escalafon}}</td>
                              <td>{{$escuelas[0]->nombre}}</td>
                              <td>
                              <a href="{{url('admin/profesores/'.$item->cedula.'/edit')}}"><button class="btn btn-info"><i class="fa  fa-pencil"></i>Editar</button></a>
                              <form style="display:inline" method="POST" action="{{action('ProfesoresController@destroy',$item->cedula)}}" nctype="multipart/form-data">
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
