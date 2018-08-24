<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>UCABV | Login</title>
	<link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" type="text/css" href="css/style.css"><!--css con fuente de icomoon-->
    <link rel="stylesheet" href="css/Estilos-Login,SignUp,Create-Password.css">
	<link rel="icon" href="/img/favicon.ico">
</head>
<body>
	<div id="superior">
		<a href="" id="inicio"><img src="/img/ucab-logo.png" width="30px" height="30px" align="center"><span><b>UCAB</b>Votaciones</span></a>
		<a href="" id="ayuda"><span class="icon-question-circle"></span> Ayuda </a>
	</div>

	<div id="login"> 
        <img src="/img/usuario.png" width="90px" height="90px">
        <form action="{{ url(config('adminlte.login_url', 'login')) }}" method="post">
        @csrf
        <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
            <input type="email" name="email" class="form-control input" value="{{ old('email') }}"
                   placeholder="&#9993; Email">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
            <input type="password" name="password" class="form-control input"
                   placeholder="&#128274; Contraseña">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
        <br>
        <a href="{{url('/preguntas')}}"> Acceder por primera vez </a> <br>
        @if(Session::has('successMsg'))
        <h4>{{ Session::get('successMsg') }}</h4>
        @endif 
	</div>	

	<div id="inferior">
        <button type="submit">Inciar sesión</button>
        </form>
	</div>

</body>
</html>