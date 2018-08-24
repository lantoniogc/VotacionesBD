@extends('adminlte::page')

@section('title', 'UCABV | Cargos por Escuelas')

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
                          <a href="{{ URL::to('admin/cargos-por-escuelas/create') }}"><button class="btn btn-success"><i class="fa  fa-plus"></i>Nuevo</button></a>
            
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
                              <th>Escuela</th>
                              <th>Cargo</th>
                            </tr>
                            @foreach ($cpe as $item)
                            <?php $escuelas = \DB::table('escuelas')->where('code_escuela','=',$item->code_escuela)->get(); ?>
                            <?php $cargos = \DB::table('cargos')->where('code_cargo','=',$item->code_cargo)->get(); ?>
                            <tr>
                              <td>{{$item->periodo}}</td>
                              <td>{{$escuelas[0]->nombre}}</td>
                              <td>{{$cargos[0]->nombre}}</td>
                              <td>
                              <form style="display:inline" method="POST" action="{{action('CargosPorEscuelasController@destroy',$item->periodo)}}" nctype="multipart/form-data">
                                @csrf
                                {{ method_field('DELETE') }} 
                                <button class="btn btn-danger"><i class="fa  fa-trash-o"></i>Borrar</button>
                              </form>  
                              </td>
                            </tr>
                            @endforeach
                          </table>

                          <div class="pag-sty"> {{ $cpe->fragment('cpe')->render() }} </div>
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
