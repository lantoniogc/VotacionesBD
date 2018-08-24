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
                <form method="POST" action="{{url('admin/profesores')}}" enctype="multipart/form-data">
                @csrf
                <label>Cedula</label>
                  <input class="form-control" type="text" placeholder="Cedula" name="cedula">
                  <br>
                <label>Nombre</label>
                  <input class="form-control" type="text" placeholder="Nombre" name="nombres">
                  <br>
                  <label>Apellido</label>
                  <input class="form-control" type="text" placeholder="Apellido" name="apellidos">
                  <br>
                  <label>Sexo</label>
                  <br>
                  <label class="radio-inline">
                    <input type="radio" name="sexo" value="Femenino">Femenino
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="sexo" value="Masculino">Masculino
                  </label>
                  <br>
                  <br>
                  <label>Tipo</label>
                  <input class="form-control" type="text" placeholder="Tipo" name="tipo" value="Profesor">
                  <br>
                  <label>Email</label>
                  <input class="form-control" type="email" placeholder="Email" name="email">
                  <br>
                  <label>Direccion</label>
                  <input class="form-control" type="text" placeholder="Direccion" name="direccion">
                  <br>
                  <label>Telefono</label>
                  <input class="form-control" type="tel" placeholder="Telefono" name="telefono_principal">
                  <br>
                  <label>Telefono Alternativo</label>
                  <input class="form-control" type="tel" placeholder="Telefono Alternativo" name="telefono_alternativo">
                  <br>
                  <label>Password</label>
                  <input class="form-control" type="password" placeholder="Password" name="password">
                  <br>
                  <label>Escuela</label>
                  <select name="code_escuela" class="form-control">
                      @foreach ($escuelas as $item)
                          <option value="{{$item->code_escuela}}">{{$item->nombre}}</option>
                      @endforeach
                  </select>
                  <br>
                  <label>Escalafon</label>
                  <input class="form-control" type="text" placeholder="Escalafon" name="escalafon">
                  <br>
                  <label>Fecha de ingreso</label>
                  <input class="form-control" type="date" placeholder="Fecha Ingreso" name="fecha_ingreso">
                  <br>
                  <button type="submit" class="btn btn-success pull-right">Crear</button>
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
    