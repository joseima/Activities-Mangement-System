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
	<h1>Nueva Noticia</h1>
	<h2 style='background-color: #ff0000'><?= $error['mensaje']?></h2>
	<form action='<?= DOMAIN?>/controlnoticias/insertar/' method='post'>
		Título de la noticia: <input type='text' name='titulo' value='<?= $error['titulo']?>'><br/>
		Día y hora: <input type="datetime-local" name='fecha' value='<?= $error['fecha']?>'><br/>
		Detalle: <textarea name='texto' value='<?= $error['texto']?>'></textarea> <br>
		<input type='submit' value='Crear'>
	</form>
	<a href='<?= DOMAIN?>/controlactividades/listar'>Volver al panel de actividades</a>
	<a href='<?= DOMAIN?>/controlusuarios/cerrarsesion'>Cerrar sesión</a>
</div>
</body>
</html>