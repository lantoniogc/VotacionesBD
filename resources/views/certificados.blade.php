<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
</head>

<body>
<div class="row">
    <div class="col-xs-8" style="margin: 0 17%;"> 
      <div class="box">
        <div class="box-header">
        </div><!-- /.box-header -->
        <h3 style="text-align: center;"><u>Certificado de Cargo</u></h3>
        <br>
        <h4 style="text-align: center;">Yo, <u> ____{{Auth::user()->nombres}} {{Auth::user()->apellidos}}_____</u></h4>
        <br>
    <h4 style="margin-left: 10%">En mi condición de <b>{{Auth::user()->tipo}}</b> de la Universidad Católica Andrés Bello de la </h4>
        <h4 style="margin-left: 10%">Extensión Guayana, de la escuela de <u>____{{$escuela[0]->nombre}}____</u> asumo</h4>
        <h4 style="margin-left: 10%">el <b>CARGO</b> de...</h4>
        <br>
        <h4 style="text-align: center;">  <b>{{$cargo[0]->nombre}}</b> </h4><br>

        <h4 style="text-align: center;">Luego de haber sido electo en las votaciones del periodo __<b><u>{{$periodoActivo[0]->periodo}}</u></b>__</h4>
        <br>
        <h4 style="margin-left: 10%">Cedula de identidad: <u>__{{Auth::user()->cedula}}__</u></h4>
        @if(Auth::user()->tipo == 'Profesor')
        <h4 style="margin-left: 10%">Escalafón: <u>___{{$profesor[0]->escalafon}}___</u></h4>
        @endif
        <h4 style="margin-left: 10%">Teléfono: <u>__{{Auth::user()->telefono_principal}}__</u></h4>
        <h4 style="margin-left: 10%">Correo electronico: <u>__{{Auth::user()->email}}__</u></h4><br>
        <img src="{{ public_path('img/aprobado.png') }}" style="margin-left: 30%; margin-bottom: 5%">
        <br>
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</body>