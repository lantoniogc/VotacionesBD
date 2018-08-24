@extends('adminlte::page')

@section('title', 'UCABV | Postulaciones')

@section('content_header')
    <h1>Postulaciones</h1>
@stop

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-8" style="margin: 0 17%;">
            <div class="box">
              <img class="img-responsive pad" src="/img/postulaciones.jpg" alt="Photo">
            </div>
        </div>
      </div> 

    <div class="row">
      <div class="col-xs-8" style="margin: 0 17%;">
        @if(Session::has('successMsg'))
          <div class="alert alert-success">{{ Session::get('successMsg') }}</div>
        @endif
        <div class="box">
          <div class="box-header">
          </div><!-- /.box-header -->
          <h3 style="text-align: center;"><u>Formulario de postulación</u></h3>
          <br>
          <h4 style="text-align: center;">Yo, <u> ____{{Auth::user()->nombres}} {{Auth::user()->apellidos}}_____</u></h4>
          <br>
          <h4 style="margin-left: 10%">En mi condición de egresado de la Universidad Católica Andrés Bello de la </h4>
          <h4 style="margin-left: 10%">Extensión Guayana, de la escuela de <u>____{{$escuelas[0]->nombre}}____</u> me postulo</h4>
          <h4 style="margin-left: 10%">como candidato al <b>CONSEJO</b> de...</h4>
          <br>
          <form method="POST" action="{{url('postulaciones')}}" enctype="multipart/form-data">
            @csrf
            <?php
              $profCount = 0;
            ?>
            @foreach ($cxe as $item)
            <?php
              $cargos = \DB::table('cargos')->where('code_cargo','=',$item->code_cargo)->get();
              $profCan = \DB::table('profesores_candidatos')
              ->where('cedula','=',\Auth::user()->cedula)
              ->where('periodo','=', $item->periodo)
              ->where('code_cargo','=', $item->code_cargo)
              ->where('code_escuela', '=', $item->code_escuela)
              ->count();
            ?>
            @if ($profCan == 0)
            <?php
              $profCount++;
            ?>
            <h4><input class="form-check-input" type="radio" class="only-one" style="margin-left: 35%" name="code_cargo" value="{{$cargos[0]->code_cargo}}">  {{$cargos[0]->nombre}} </h4>
            @endif
            @endforeach
            @if ($profCount == 0)
            <div class="alert alert-danger"><h4 style="margin-left: 35%">No hay cargos disponibles</h4></div>
            @endif
          <br>
          <h4 style="margin-left: 10%">Cedula de identidad: <u>__{{Auth::user()->cedula}}__</u></h4>
          <h4 style="margin-left: 10%">Escalafón: <u>___{{$profesores[0]->escalafon}}___</u></h4>
          <h4 style="margin-left: 10%">Teléfono: <u>__{{Auth::user()->telefono_principal}}__</u></h4>
          <h4 style="margin-left: 10%">Correo electronico: <u>__{{Auth::user()->email}}__</u></h4><br>
          <h4><input type="checkbox" required style="margin-left: 18%">  Acepto los términos y condiciones para la postulación </h4><br>
          <br>
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="row">
        <div class="col-xs-8"></div>
      <div class="col-xs-2">
        <button type="submit" class="btn btn-block btn-success "><b>Postularse  <i class="fa fa-bookmark"></i></b></button>
        </form>
      </div>
    </div>
    
    
  </section>
  <!-- /.content -->
@stop