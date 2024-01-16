<!DOCTYPE html>
<html>
<head>
	<?php
	session_start();
	if ( isset($_SESSION['usuario'])) {
		// Existen: Se almacenen en la variable $usuario
		$usuariologueado = $_SESSION['usuario'];
		echo $usuariologueado['usuario'];
	} else {
			header('Location: '.DOMAIN);
	}?>
<meta charset="utf-8">
<title></title>
<script src="<?= JS_SCRIPTS ?>/jquery-3.5.1.min.js"></script>
<link rel="stylesheet" href="<?= CSS ?>/main.css">
<script>
	$().ready(function() {
		$('form').submit(function(e){
			var user = $(this).find('input:hidden').val();
			var response = confirm("Desea eliminar usuario: " + user );
			if ( !response) e.preventDefault();
		});
	});
</script>
</head>
<body>
	<header>
		<img src="<?= DOMAIN ?>/LogoCreuRojaWebHome.jpg">
		<h1>Panel de Actividades y Noticias para Voluntarios</h1>
		<h3>Centro de Acollida Integral Nou Barris - Creu Roja Barcelona</h3>
	</header>
	

	<div class="contenido">
	<h1>LISTADO DE VOLUNTARIOS</h1>
	<h1>Bienvenid@ <?= $usuariologueado['usuario'] ?></h1>
	<?php if ($usuariologueado['administrador'] === "1") {
		echo "<p>Administrador</p><br><a href='".DOMAIN."/controlusuarios/nuevo'>Insertar nuevo usuario</a><br/>";
	} else {
		echo "<p>Voluntario</p>"; 
	}
	?>
	
	<table border='1' class="table">
	<thead>
		<tr>
		<th>Usuario</th>
		<th>Clave</th>
		<th>Email</th>
		<th>Telefono</th>
		</tr>
	</thead>
	<tbody>
	<?php
	foreach ($users as $user) { ?>
		<tr>
			<td>
			<?php if ($usuariologueado['administrador'] === "1") { 
					$nombreMod= $user->nombre;
					$nombreMod = str_replace(" ","DeLtA",$nombreMod);?>
					<a href='<?= DOMAIN?>/controlusuarios/ver/<?=$nombreMod?>'><?=$user->nombre ?></a>
			<?php } else {?>
				<p><?=$user->nombre ?></p>
			<?php }?>
			</td>
			<td><?= $user->clave ?></td>
			<td><a href="mailto:<?= $user->mail ?>" target="_blank"><?= $user->mail ?></a></td>
			<td><?= $user->telefono ?></td>
			<?php if ($usuariologueado['administrador'] === "1") { ?>
				<td>
					<form action='<?=DOMAIN?>/controlusuarios/eliminar' method='post'>
						<input type='hidden' name='usuario' value='<?= $user->nombre?>'>
						<input type='submit' value='Eliminar'>
					</form>
				</td>
			<?php } ?>
		</tr>
	<?php } ?>
	</tbody>
	</table>
	<a href='<?= DOMAIN?>/controlactividades/listar'>Volver al panel de actividades</a>
	<a href='<?= DOMAIN?>/controlusuarios/cerrarsesion'>Cerrar sesión</a>
</div>

</body>
</html>