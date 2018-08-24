@extends('adminlte::page')

@section('title', 'UCABV | Profesores')

@section('content_header')
    <h1>Panel de Administracion</h1>
@stop

@section('content')

<!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
        <div class="col-md-8">
        <!-- Form Element sizes -->
          <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Profesores</h3>
                </div>
                <div class="box-body">
                <form method="POST" action="{{action('ProfesoresController@update',$profesores[0]->cedula)}}" nctype="multipart/form-data">
                @csrf
                {{ method_field('PATCH') }}
                <label>Cedula</label>
                  <input class="form-control" type="text" placeholder="Cedula" name="cedula" value='{{$profesores[0]->cedula}}' disabled>
                  <br>
                <label>Nombre</label>
                  <input class="form-control" type="text" placeholder="Nombre" name="nombres" value='{{$usuarios[0]->nombres}}'>
                  <br>
                  <label>Apellido</label>
                  <input class="form-control" type="text" placeholder="Apellido" name="apellidos" value='{{$usuarios[0]->apellidos}}'>
                  <br>
                  <label>Sexo</label>
                  <br>
                  @if($usuarios[0]->sexo == 'Femenino')
                  <label class="radio-inline active">
                    <input type="radio" name="sexo" checked="" value="Femenino">Femenino
                  </label>
                  <label class="radio-inline disabled">
                    <input type="radio" name="sexo" value="Masculino">Masculino
                  </label>
                  @else
                  <label class="radio-inline disabled">
                    <input type="radio" name="sexo" value="Femenino">Femenino
                  </label>
                  <label class="radio-inline active">
                    <input type="radio" name="sexo" checked="" value="Masculino">Masculino
                  </label>
                  @endif  
                  <br>
                  <br>
                  <label>Tipo</label>
                  <input class="form-control" type="text" placeholder="Tipo" name="tipo" value='{{$usuarios[0]->tipo}}' disabled>
                  <br>
                  <label>Email</label>
                  <input class="form-control" type="email" placeholder="Email" name="email" value='{{$usuarios[0]->email}}'>
                  <br>
                  <label>Direccion</label>
                  <input class="form-control" type="text" placeholder="Direccion" name="direccion" value='{{$usuarios[0]->direccion}}'>
                  <br>
                  <label>Telefono</label>
                  <input class="form-control" type="tel" placeholder="Telefono" name="telefono_principal" value='{{$usuarios[0]->telefono_principal}}'>
                  <br>
                  <label>Telefono Alternativo</label>
                  <input class="form-control" type="tel" placeholder="Telefono Alternativo" name="telefono_alternativo" value='{{$usuarios[0]->telefono_alternativo}}'>
                  <br>
                  <label>Password</label>
                  <input class="form-control" type="password" placeholder="Password" name="password">
                  <br>
                  <label>Escuela</label>
                  <select name="code_escuela" class="form-control">
                      @foreach ($escuelas as $item)
                        @if($item->code_escuela == $profesores[0]->code_escuela)
                          <option selected="selected" value="{{$item->code_escuela}}">{{$item->nombre}}</option>
                        @else
                          <option value="{{$item->code_escuela}}">{{$item->nombre}}</option>
                        @endif
                      @endforeach
                  </select>
                  <br>
                  <label>Escalafon</label>
                  <input class="form-control" type="text" placeholder="Escalafon" name="escalafon" value='{{$profesores[0]->escalafon}}'>
                  <br>
                  <label>Fecha de ingreso</label>
                  <input class="form-control" type="date" placeholder="Fecha Ingreso" name="fecha_ingreso" value='{{$profesores[0]->fecha_ingreso}}'>
                  <br>
                  <button type="submit" class="btn btn-success pull-right">Editar</button>
                  </form>
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
    