<!DOCTYPE html>
<html>
<head>
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
		<h1>DETALLE Voluntario <?= $user->nombre ?></h1>
		<form action='<?= DOMAIN?>/controlusuarios/actualizar/' method='post'>
			<input type='hidden' name='usuario' value='<?= $user->nombre?>'>
			Clave: <input type='text' name='clave' value='<?= $user->clave?>'><br/>
			Administrador: <input type='checkbox' name='administrador'
		<?= (($user->administrador==1)?'checked':'') ?>><br/>
		Activo: <input type='checkbox' name='activo'
		<?= (($user->activo==1)?'checked':'') ?>><br/>
			<input type='submit' value='modificar'>
		</form>
		<a href='<?= DOMAIN?>/controlusuarios/listar'>Volver a lista usuarios</a>
		<a href='<?= DOMAIN?>/controlusuarios/cerrarsesion'>Cerrar sesión</a>
	</div>
	</body>
</html>