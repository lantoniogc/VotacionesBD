@extends('adminlte::page')

@section('title', 'UCABV | Votaciones')

@section('content_header')
    <h1>Votaciones</h1>
@stop

@section('content')
        <!-- Main content -->
        <section class="content">
                <div class="row">
                  <div class="col-xs-8" style="margin: 0 17%;">
                      <div class="box">
                        <img class="img-responsive pad" src="/img/votaciones.jpg" alt="Photo">
                      </div>
                  </div>
                </div> 
                <div class="col-xs-2">
                </div>
                <div class="row">
                  <div class="col-xs-7"> 
                      @if(Session::has('successMsg'))
                      <div class="alert alert-success">{{ Session::get('successMsg') }}</div>
                    @endif
                    <div class="box">
                      <div class="box-header">
                        <label>Secciones por votar</label>
                      </div><!-- /.box-header -->
                      <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                          <thead>
                            <tr class="bg-green">
                              <th>Sección</th>
                              <th>Selección</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($cxe as $item)
                            <?php
                              $cargos = \DB::table('cargos')->where('code_cargo','=',$item->code_cargo)->get();
                              $votoValido = \DB::table('egresados_vota_por')
                              ->where('cedula_e','=',\Auth::user()->cedula)
                              ->where('periodo_re','=',$periodoActivo[0]->periodo)
                              ->where('code_escuela','=',$item->code_escuela)
                              ->where('code_cargo','=',$item->code_cargo)
                              ->count();
                            ?>
                            @if ($votoValido == 0)
                            <tr>
                              <td><a href="{{url('/votaciones/'.$item->code_cargo)}}">{{$cargos[0]->nombre}}</a></td>
                              <td><span class="badge badge-primary">EN ESPERA</span></td>
                            </tr>
                            @else
                            <tr>
                                <td>{{$cargos[0]->nombre}}</td>
                                <td><span class="badge badge-danger">LISTO</span></td>
                              </tr>
                            @endif
                            @endforeach
                          </tbody>
                        </table>
                        <div class="pag-sty"> {{ $cxe->fragment('cxe')->render() }} </div>
                      </div><!-- /.box-body -->
                    </div><!-- /.box -->
                  </div><!-- /.col -->
                </div>                
      
              </section>
              <!-- /.content -->
@stop              