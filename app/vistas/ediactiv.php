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
		<h1>Detalles de la Actividad <?= $actividad->nombre ?></h1>
		<form action='<?= DOMAIN?>/controlactividades/actualizar/' method='post'>
			<input type='hidden' name='nombre' value='<?= $actividad->nombre?>'>
			Nuevo nombre: <input type='text' name='nuevonombre' value='<?= $actividad->nombre?>'><br/>
			Categoria: <input type='text' name='categoria' value='<?= $actividad->categoria?>'><br/>
			Dia(Actualmente <?= $actividad->dia?>):     
			<select id="dia" multiple="false" name="dia" size="7">
		      <option value="Lunes">Lunes</option>
		      <option value="Martes">Martes</option>
		      <option value="Miércoles">Miércoles</option>
		      <option value="Jueves">Jueves</option>
		      <option value="Viernes">Viernes</option>
		      <option value="Sábado">Sábado</option>
		      <option value="Domingo">Domingo</option>
		    </select><br/>
			Hora: <input type='time' name='hora' value='<?= $actividad->hora?>'><br/>
			Detalle: <input type='text' name='detalle' value='<?= $actividad->detalle?>'><br/>
			Voluntario asignado: <input type='text' name='voluntario' value='<?= $actividad->voluntario?>'><br/>

			<input type='submit' value='modificar'>
		</form>
		<a href='<?= DOMAIN?>/controlactividades/listar'>Volver al panel de actividades</a>
		<a href='<?= DOMAIN?>/controlusuarios/cerrarsesion'>Cerrar sesión</a>
	</div>
	</body>
</html>