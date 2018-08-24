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
        <h3>Establezca una contraseña</h3>
        <form action="{{action('Auth\ResetPasswordController@actualizar',$id)}}" method="post" nctype="multipart/form-data">
        @csrf
        {{ method_field('PATCH') }}
		<input class="input" type="password" name="password" placeholder="&#128100; Contraseña" required><br>
	</div>

	<div id=botones>
        <button type="submit" class="boton-aceptar">Aceptar</button>
        </form>
		<a href="{{url('login')}}"><button class="boton-cancelar">Cancelar</button></a>
	</div>	

</body>
</html>