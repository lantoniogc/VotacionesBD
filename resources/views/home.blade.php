@extends('adminlte::page')

@section('title', 'UCABV | Cartelera Informativa')

@section('content_header')
    <h1>Cartelera Informativa</h1>
@stop

@section('content')
<div class="row">
    @if(Session::has('errorMsg'))
    <div class="alert alert-danger">{{ Session::get('errorMsg') }}</div>
  @endif      
    <div class="col-md-5">
      <div class="box box-danger box-solid collapsed-box">
        <div class="box-header with-border">
          <strong>Conoce un poco mas de tu Universidad.</strong>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse" title data-original-title="Ver">
              <i class="fa fa-plus"></i>
            </button>
          </div>
        </div>
        <div class="box-body" style="display:none;">
          <img class="img-responsive pad" src="/img/ucab-plano.jpg" alt="Photo">
        </div>
        <div class="box-footer" style="display: none;">
          <p>
            <b>La Ucab Guayana </b>cuenta con cuatro módulos de aulas acondicionados especialmente para la labor académica.
            Una espaciosa y moderna infraestructura conforma la Biblioteca Central la cual alberga un nutrido fondo bibliográfico a la disposición de estudiantes, profesores y público en general. 
          </p>
        </div>
      </div>
      <div class="col-md-13">
      <div class="box  box-success ">
        <div class="box-header width-border">
          <b>Estadisticas</b>
        </div>
        <div class="box-body">
          <div class="info-box bg-aqua">
            <span class="info-box-icon">
              <i class="fa fa-graduation-cap"></i>
            </span>   
            <div class="info-box-content">
            <span class="info-box-text">
              Graduados
            </span>
            <span class="info-box-number">
              41,410
            </span>
            <div class="progress">
              <div class="progress-bar" style="width:70%"></div>
            </div>
            <span class="progress-description"> 70% de los Estudiantes se graduan en 10 semestres</span>
            </div>
          </div>
          <div class="info-box bg-green">
            <span class="info-box-icon">
              <i class="fa fa-clipboard"></i>
            </span>   
            <div class="info-box-content">
            <span class="info-box-text">
              Profesores
            </span>
            <span class="info-box-number">
              15,012
            </span>
            <div class="progress">
              <div class="progress-bar" style="width:20%"></div>
            </div>
            <span class="progress-description"> 20% de los egresados se dedican a la educacion</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    <div class="col-md-6">
        <div class="box box-solid">
            <div class="box-header with-border">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                  <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                  <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                </ol>
                <div class="carousel-inner">
                  <div class="item active">
                    <a href="/news/{{$lastnew->idart}}"><img src="{{$lastnew->url_img}}" alt="First slide"></a>
                    <div class="carousel-caption">
                      {{$lastnew->titulo}}
                    </div>
                  </div>
                  @foreach ($carouselnews as $item)
                  <div class="item">
                    <a href="/news/{{$item->idart}}"><img src="{{$item->url_img}}" alt="Second slide"></a>
                    <div class="carousel-caption">
                      {{$item->titulo}}
                    </div>
                  </div>
                  @endforeach
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                  <span class="fa fa-angle-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                  <span class="fa fa-angle-right"></span>
                </a>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        <div class="col-md-14">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title"><b>Contactanos</b></h3>
          </div>
          <div class="box-body">
            <a class="btn btn-block btn-social btn-dropbox">
                <i class="fa fa-dropbox" aria-hidden="true"></i> En Dropbox
            </a>
            <a class="btn btn-block btn-social btn-facebook">
              <i class="fa fa-facebook" aria-hidden="true"></i> En Facebook
            </a>
            <a class="btn btn-block btn-social btn-google">
                <i class="fa fa-google-plus" aria-hidden="true"></i> En Google
            </a>
            <a class="btn btn-block btn-social btn-instagram">
                <i class="fa fa-instagram" aria-hidden="true"></i> En Instagram
            </a>
          </div>
        </div>
        </div>            
      </div> 
     </div>
  </section>
@stop