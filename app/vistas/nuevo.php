<!DOCTYPE html>
<html>
<head>
<?php
	session_start();
	if ( isset($_SESSION['usuario'])) {
		$usuariologueado = $_SESSION['usuario'];
	}
	if ($usuariologueado['administrador'] === "0") {
		header('Location: '.DOMAIN);	
	}
	?>
<meta charset="utf-8">
<link rel="stylesheet" href="<?= CSS ?>/main.css">
<title></title>
</head>
<body>
		<header>
		<img src="<?= DOMAIN ?>/LogoCreuRojaWebHome.jpg">
		<h1>Panel de Actividades y Noticias para Voluntarios</h1>
		<h3>Centro de Acollida Integral Nou Barris - Creu Roja Barcelona</h3>
	</header>
	

	<div class="contenido">
	<h1>Nuevo Voluntario</h1>
	<h2 style='background-color: #ff0000'><?= $error['mensaje']?></h2>
	<form action='<?= DOMAIN?>/controlusuarios/insertar/' method='post'>
		Usuario: <input type='text' name='usuario' value='<?= $error['nombre']?>'>
		Clave: <input type='text' name='clave' value='<?= $error['clave']?>'><br/>
		Email: <input type='text' name='mail' value='<?= $error['mail']?>'>
		Telefono: <input type='text' name='telefono' value='<?= $error['telefono']?>'><br/>
		Administrador: <input type='checkbox' name='administrador'
	<?=(($error['administrador']==1)?'1':'')?>><br/>
	Activo: <input type='checkbox' name='activo'
	<?=(($error['activo']==1)?'1':'')?>><br/>
		<input type='submit' value='registrar'>
	</form>
	<a href='<?= DOMAIN?>/controlusuarios/listar'>Volver a lista de Voluntarios</a>
	<a href='<?= DOMAIN?>/controlusuarios/cerrarsesion'>Cerrar sesión</a>
</div>
</body>
</html>