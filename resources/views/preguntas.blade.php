<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>UCABVotaciones | Recuperación</title>
	<link rel="stylesheet" href="/css/estilos.css">
	<link rel="stylesheet" type="text/css" href="/css/style.css"><!--css con fuente de icomoon-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css">
	<link rel="icon" href="/img/favicon.ico">

</head>
<body>
	<div id="superior">
		<a href="" id="inicio"><img src="/img/ucab-logo.png" width="30px" height="30px" align="center"><span><b>UCAB</b>Votaciones</span></a>
		<a href="" id="ayuda"><span class="icon-question-circle"></span> Ayuda </a>
	</div>

	<div id="formulario-registro">
		<h2 align="left"><i class="fa fa-user-shield"></i> Asistencia<span>Cuenta</span></h2>
		@if(Session::has('errorMsg'))
		<h4>{{ Session::get('errorMsg') }}</h4>
	  	@endif    
		<h3>Responda las siguientes preguntas</h3>
        <form action="{{url('preguntas')}}" method="post">
		@csrf
		<input  class="input" type="text" name="cedula" placeholder="&#128100; Cedula" required><br>
		<input class="input" type="text" name="email" placeholder="&#9993; E-mail" required><br>
		<input class="input" type="text" name="nombres" placeholder="&#128100; Nombre(s)" required><br>
	</div>

	<div id=botones>
		<button type="submit" class="boton-aceptar">Aceptar</button>
		</form>
		<a href="{{url('login')}}"><button class="boton-cancelar">Cancelar</button></a>
	</div>	

</body>
</html>