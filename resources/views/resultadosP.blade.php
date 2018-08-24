<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/estilosErick.css">
        <link rel="stylesheet" type="text/css" href="css/Estilos-JulioFlores.css">  
</head>

<body>
        <div>
          <img class="Logo-UCAB" src="{{ public_path('img/ucab.png') }}" alt="Logo"> 
        </div>
        
        <div class="Titulo">
          Resultados de las Votaciones de Profesores [Periodo: {{$periodoActivo[0]->periodo}}]
        </div> 

        <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->  
        <!-- Consejo Universitario --> 
        @foreach($cxe as $item)
        <?php
          $cargos = \DB::table('cargos')->where('code_cargo','=',$item->code_cargo)->get();
          $profesores_candidatos = \DB::table('profesores_candidatos')
          ->where('periodo','=',$item->periodo)
          ->where('code_escuela','=',$item->code_escuela)
          ->where('code_cargo','=',$item->code_cargo)
          ->orderBy('votos')->take(2)->get();
          $profesoresCount = \DB::table('profesores_candidatos')
          ->where('periodo','=',$item->periodo)
          ->where('code_escuela','=',$item->code_escuela)
          ->where('code_cargo','=',$item->code_cargo)
          ->orderBy('votos')->count();

        ?>
        @if($profesoresCount != 0)
        <div class="Tittle-Table">
            <h3>{{$cargos[0]->nombre}} </h3>
          </div> 
          <table class="table Tablas"> 
            <thead class="thead-dark">
              <tr>
              <th scope="col">Nombres</th>
              <th scope="col">Total de Votos</th>
              </tr>
            </thead>


            <tbody>
              @foreach($profesores_candidatos as $prof)
              <?php
                $profesor = \DB::table('users')
                ->where('cedula','=',$prof->cedula)->get();
              ?>
              <tr>
              <th>{{$profesor[0]->nombres.' '.$profesor[0]->apellidos}}</th>
              <td class="font-weight-bold">{{$prof->votos}}</td> 
              </tr>
              @endforeach
            </tbody>
          </table>
          @endif
          <div class="Separador"></div>
          @endforeach
          <!-- ////////////////////////////////////////////////////////// -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->   
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->   
           
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>           
</body>