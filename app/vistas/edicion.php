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
		<h1>Detalle del voluntario <?= $user->nombre ?></h1>
		<form action='<?= DOMAIN?>/controlusuarios/actualizar/' method='post'>
			<input type='hidden' name='usuario' value='<?= $user->nombre?>'>
			Clave: <input type='text' name='clave' value='<?= $user->clave?>'><br/>
			E-amil: <input type='text' name='mail' value='<?= $user->mail?>'><br/>
			Teléfono: <input type='text' name='telefono' value='<?= $user->telefono?>'><br/>
			Administrador: <input type='checkbox' name='administrador'
		<?= (($user->administrador==1)?'checked':'') ?>><br/>
		Activo: <input type='checkbox' name='activo'
		<?= (($user->activo==1)?'checked':'') ?>><br/>
			<input type='submit' value='modificar'>
		</form>
		<a href='<?= DOMAIN?>/controlusuarios/listar'>Volver a lista de voluntarios</a>
		<a href='<?= DOMAIN?>/controlusuarios/cerrarsesion'>Cerrar sesión</a>
	</div>
	</body>
</html>