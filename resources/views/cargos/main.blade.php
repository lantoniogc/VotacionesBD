@extends('adminlte::page')

@section('title', 'UCABV | Cargos')

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
                          <a href="{{ URL::to('admin/cargos/create') }}"><button class="btn btn-success"><i class="fa  fa-plus"></i>Nuevo</button></a>
            
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
                              <th>Code_Cargo</th>
                              <th>Nombre</th>
                            </tr>
                            @foreach ($cargos as $item)
                            <tr>
                              <td>{{$item->code_cargo}}</td>
                              <td>{{$item->nombre}}</td>
                              <td>
                              <a href="{{url('admin/cargos/'.$item->code_cargo.'/edit')}}"><button class="btn btn-info"><i class="fa  fa-pencil"></i>Editar</button></a>
                              <form style="display:inline" method="POST" action="{{action('CargosController@destroy',$item->code_cargo)}}" nctype="multipart/form-data">
                                @csrf
                                {{ method_field('DELETE') }} 
                                <button class="btn btn-danger"><i class="fa  fa-trash-o"></i>Borrar</button>
                              </form>  
                              </td>
                            </tr>
                            @endforeach
                          </table>

                          <div class="pag-sty"> {{ $cargos->fragment('cargos')->render() }} </div>
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
