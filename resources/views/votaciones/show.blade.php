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

                <div class="row">
                <div class="col-xs-3">
                </div>

                <div class="col-xs-6">
                        <h3>{{$cargo[0]->nombre}}</h3>
                        <div class="box">
                            @foreach($candidatos as $item)
                            <?php
                                $candidatoActual = \DB::table('users')->where('cedula','=',$item->cedula)->get();
                                $escuelaCandidato = \DB::table('escuelas')->where('code_escuela','=',$item->code_escuela)->get();
                            ?>
                        <!-- Cuadro de los usuarios -->
                          <div class="box box-primary">
                          <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle" src="/img/testvota.png" alt="User profile picture" style="float: left;">
                          <h4><b>{{$candidatoActual[0]->nombres.' '.$candidatoActual[0]->apellidos}}</b></h4>
                          <h5 style="margin-left: 35%">{{$escuelaCandidato[0]->nombre}}</h5>
                          <form method="POST" action="{{url('votaciones/'.$candidatoActual[0]->cedula)}}" enctype="multipart/form-data">
                            @csrf
                            <td><input class="form-check-input" type="radio" name="cedula" value="{{$candidatoActual[0]->cedula}}" style="float: right;"><h5 style="margin-left: 90%"><b>Votar</b></h5></td>
                          </div>
                        </div><!--/CuadroDeUsuario-->
                        @endforeach
                        <div class="pag-sty"> {{ $candidatos->fragment('candidatos')->render() }} </div>
                       </div><!-- /.box -->
                      </div><!-- /.col -->
                    </div>
                    <input type="hidden" name="code_cargo" value="{{$cargo[0]->code_cargo}}">
                    <button class="btn btn-block btn-success btn-lg" type="submit" >Votar <i class="fa fa-edit"></i></button>
                </form>
@stop