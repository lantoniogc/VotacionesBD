@extends('adminlte::page')

@section('title', 'UCABV | Impugnaciones')

@section('content_header')
    <h1>Impugnaciones</h1>
@stop

@section('content')
<h4>Profesores</h4>
<div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
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
              <th>Periodo</th>
              <th>Code_Escuela</th>
              <th>Code_Cargo</th>
            </tr>
            @foreach ($PC as $item)
            <tr>
              <td>{{$item->cedula}}</td>
              <td>{{$item->periodo}}</td>
              <td>{{$item->code_escuela}}</td>
              <td>{{$item->code_cargo}}</td>
              <td>
              <form style="display:inline" method="POST" action="{{action('ImpugnacionesController@destroy',$item->cedula)}}" nctype="multipart/form-data">
                @csrf
                {{ method_field('DELETE') }} 
                <button class="btn btn-danger"><i class="fa  fa-trash-o"></i>Borrar</button>
              </form>  
              </td>
            </tr>
            @endforeach
          </table>

          <div class="pag-sty"> {{ $PC->fragment('PC')->render() }} </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>

  <h4>Egresados</h4>
  <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
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
                <th>Periodo</th>
                <th>Code_Escuela</th>
                <th>Code_Cargo</th>
              </tr>
              @foreach ($EC as $item)
              <tr>
                <td>{{$item->cedula}}</td>
                <td>{{$item->periodo}}</td>
                <td>{{$item->code_escuela}}</td>
                <td>{{$item->code_cargo}}</td>
                <td>
                <form style="display:inline" method="POST" action="{{action('ImpugnacionesController@destroy',$item->cedula)}}" nctype="multipart/form-data">
                  @csrf
                  {{ method_field('DELETE') }} 
                  <button class="btn btn-danger"><i class="fa  fa-trash-o"></i>Borrar</button>
                </form>  
                </td>
              </tr>
              @endforeach
            </table>
  
            <div class="pag-sty"> {{ $EC->fragment('EC')->render() }} </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </div>  
@stop