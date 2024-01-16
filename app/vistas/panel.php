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
		$('#eliminar').submit(function(e){
			var nombre = $(this).find('input:hidden').val();
			var response = confirm("Desea eliminar actividad: " + nombre );
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
	

	<div class="main">
		<div class="ficha">
			<h2>Bienvenid@ <?= $usuariologueado['usuario'] ?></h2>
			<?php if ($usuariologueado['administrador'] === "1") { ?>
				<p>Administrador</p>
				<a href='<?= DOMAIN?>/controlnoticias/nuevo'>Insertar una Noticia</a>
				<a href='<?= DOMAIN?>/controlactividades/nuevo'>Insertar nueva Actividad</a>
				<a href='<?= DOMAIN?>/controlusuarios/listar'>Gestionar Voluntarios</a>
			<?php } else { ?>
				<p>Voluntario</p>
				<p class="asignadas">Tareas asignadas:</p> 
				<?php foreach ($actividades as $actividad) { 
					 if ($actividad->voluntario == $usuariologueado['usuario']) { ?>
								<h5><?=$actividad->nombre ?></h5>
					<?php }
				 }?>
				<a href='<?= DOMAIN?>/controlusuarios/listar'>Ver lista de Voluntarios</a>  
			 <?php }	?>
			<a href='<?= DOMAIN?>/controlusuarios/cerrarsesion'>Cerrar sesión</a>
		</div>
		<div class="news">

			<?php 

				$totalAct = count($actividades);
				$totalAct = $totalAct - 1;	
				foreach ($actividades[$totalAct] as $noticia) { 
				?>
				<div class="noticia">
					<p><?=$noticia->fecha ?></p>
					<h3><?=$noticia->titulo ?></h3>
					<h5><?=$noticia->texto ?></h5>
					<?php if ($usuariologueado['administrador'] === "1") { ?>
							<form id="eliminar" action='<?=DOMAIN?>/controlnoticias/eliminar' method='post'>
								<input type='hidden' name='titulo' value='<?= $noticia->titulo?>'>
								<input type='submit' value='Eliminar'>
							</form>
					<?php }  ?>
				<p class="control_next">></p>
  				<p class="control_prev"><</p>
				</div>
			<?php 
			} ?>
		</div>
	</div>
		<h2 class="titulosec">Listado de Actividades</h2>
		<h2 class='mensaje'><?= $error['mensaje']?></h2>
	<div class="content">

		<div class="dia lunes">
			<h2>Día Lunes</h2>
			<?php
			foreach ($actividades as $actividad) { 
				if ( $actividad->dia == "Lunes") { ?>
					<div class="card">
						<div class="carTitle">
							<h3><?=$actividad->nombre ?></h3>
							<h5>Categoria de la actividad: <?= $actividad->categoria ?></h5>
						</div>
						<p>Hora: <?= $actividad->hora ?></p>
						<p class="detalle">Detalle: <?= $actividad->detalle ?></p>
						<p>Voluntario asignado: <b><?= $actividad->voluntario ?></b> </p>
								<?php if ($usuariologueado['administrador'] === "1") { 
										$nombreMod= $actividad->nombre;
										$nombreMod = str_replace(" ","DeLtA",$nombreMod);?>
										<a class="accion" href='<?= DOMAIN?>/controlactividades/ver/<?=$nombreMod?>'>Editar</a>
										<form id="eliminar" action='<?=DOMAIN?>/controlactividades/eliminar' method='post'>
											<input type='hidden' name='nombre' value='<?= $actividad->nombre?>'>
											<input type='submit' value='Eliminar'>
										</form>
								<?php } else if ($actividad->voluntario == "") {?>
										<form action='<?=DOMAIN?>/controlactividades/asignar' method='post'>
											<input type='hidden' name='nombre' value='<?= $actividad->nombre?>'>
											<input type='hidden' name='voluntario' value='<?= $usuariologueado['usuario']?>'>
											<input type='submit' value='Asignarme esta tarea'>
										</form>
								<?php } ?>
					</div>
			<?php }
			} ?>
		</div>
		<div class="dia martes">
			<h2>Día Martes</h2>
			<?php
			foreach ($actividades as $actividad) { 
				if ( $actividad->dia == "Martes") { ?>
					<div class="card">
						<div class="carTitle">
							<h3><?=$actividad->nombre ?></h3>
							<h5>Categoria de la actividad: <?= $actividad->categoria ?></h5>
						</div>
						<p>Hora: <?= $actividad->hora ?></p>
						<p class="detalle">Detalle: <?= $actividad->detalle ?></p>
						<p>Voluntario asignado: <b><?= $actividad->voluntario ?></b> </p>
								<?php if ($usuariologueado['administrador'] === "1") { 
										$nombreMod= $actividad->nombre;
										$nombreMod = str_replace(" ","DeLtA",$nombreMod);?>
										<a class="accion" href='<?= DOMAIN?>/controlactividades/ver/<?=$nombreMod?>'>Editar</a>
										<form id="eliminar" action='<?=DOMAIN?>/controlactividades/eliminar' method='post'>
											<input type='hidden' name='nombre' value='<?= $actividad->nombre?>'>
											<input type='submit' value='Eliminar'>
										</form>
								<?php } else if ($actividad->voluntario == "") {?>
										<form action='<?=DOMAIN?>/controlactividades/asignar' method='post'>
											<input type='hidden' name='nombre' value='<?= $actividad->nombre?>'>
											<input type='hidden' name='voluntario' value='<?= $usuariologueado['usuario']?>'>
											<input type='submit' value='Asignarme esta tarea'>
										</form>
								<?php } ?>
					</div>
			<?php }
			} ?>
		</div>
		<div class="dia miercoles">
			<h2>Día Miércoles</h2>
			<?php
			foreach ($actividades as $actividad) { 
				if ( $actividad->dia == "Miércoles") { ?>
					<div class="card">
						<div class="carTitle">
							<h3><?=$actividad->nombre ?></h3>
							<h5>Categoria de la actividad: <?= $actividad->categoria ?></h5>
						</div>
						<p>Hora: <?= $actividad->hora ?></p>
						<p class="detalle">Detalle: <?= $actividad->detalle ?></p>
						<p>Voluntario asignado: <b><?= $actividad->voluntario ?></b> </p>
								<?php if ($usuariologueado['administrador'] === "1") { 
										$nombreMod= $actividad->nombre;
										$nombreMod = str_replace(" ","DeLtA",$nombreMod);?>
										<a class="accion" href='<?= DOMAIN?>/controlactividades/ver/<?=$nombreMod?>'>Editar</a>
										<form id="eliminar" action='<?=DOMAIN?>/controlactividades/eliminar' method='post'>
											<input type='hidden' name='nombre' value='<?= $actividad->nombre?>'>
											<input type='submit' value='Eliminar'>
										</form>
								<?php } else if ($actividad->voluntario == "") {?>
										<form action='<?=DOMAIN?>/controlactividades/asignar' method='post'>
											<input type='hidden' name='nombre' value='<?= $actividad->nombre?>'>
											<input type='hidden' name='voluntario' value='<?= $usuariologueado['usuario']?>'>
											<input type='submit' value='Asignarme esta tarea'>
										</form>
								<?php } ?>
					</div>
			<?php }
			} ?>
		</div>
		<div class="dia jueves">
			<h2>Día jueves</h2>
			<?php
			foreach ($actividades as $actividad) { 
				if ( $actividad->dia == "Jueves") { ?>
					<div class="card">
						<div class="carTitle">
							<h3><?=$actividad->nombre ?></h3>
							<h5>Categoria de la actividad: <?= $actividad->categoria ?></h5>
						</div>
						<p>Hora: <?= $actividad->hora ?></p>
						<p class="detalle">Detalle: <?= $actividad->detalle ?></p>
						<p>Voluntario asignado: <b><?= $actividad->voluntario ?></b> </p>
								<?php if ($usuariologueado['administrador'] === "1") { 
										$nombreMod= $actividad->nombre;
										$nombreMod = str_replace(" ","DeLtA",$nombreMod);?>
										<a class="accion" href='<?= DOMAIN?>/controlactividades/ver/<?=$nombreMod?>'>Editar</a>
										<form id="eliminar" action='<?=DOMAIN?>/controlactividades/eliminar' method='post'>
											<input type='hidden' name='nombre' value='<?= $actividad->nombre?>'>
											<input type='submit' value='Eliminar'>
										</form>
								<?php } else if ($actividad->voluntario == "") {?>
										<form action='<?=DOMAIN?>/controlactividades/asignar' method='post'>
											<input type='hidden' name='nombre' value='<?= $actividad->nombre?>'>
											<input type='hidden' name='voluntario' value='<?= $usuariologueado['usuario']?>'>
											<input type='submit' value='Asignarme esta tarea'>
										</form>
								<?php } ?>
					</div>
			<?php }
			} ?>
		</div>
		<div class="dia viernes">
			<h2>Día Viernes</h2>
			<?php
			foreach ($actividades as $actividad) { 
				if ( $actividad->dia == "Viernes") { ?>
					<div class="card">
						<div class="carTitle">
							<h3><?=$actividad->nombre ?></h3>
							<h5>Categoria de la actividad: <?= $actividad->categoria ?></h5>
						</div>
						<p>Hora: <?= $actividad->hora ?></p>
						<p class="detalle">Detalle: <?= $actividad->detalle ?></p>
						<p>Voluntario asignado: <b><?= $actividad->voluntario ?></b> </p>
								<?php if ($usuariologueado['administrador'] === "1") { 
										$nombreMod= $actividad->nombre;
										$nombreMod = str_replace(" ","DeLtA",$nombreMod);?>
										<a class="accion" href='<?= DOMAIN?>/controlactividades/ver/<?=$nombreMod?>'>Editar</a>
										<form id="eliminar" action='<?=DOMAIN?>/controlactividades/eliminar' method='post'>
											<input type='hidden' name='nombre' value='<?= $actividad->nombre?>'>
											<input type='submit' value='Eliminar'>
										</form>
								<?php } else if ($actividad->voluntario == "") {?>
										<form action='<?=DOMAIN?>/controlactividades/asignar' method='post'>
											<input type='hidden' name='nombre' value='<?= $actividad->nombre?>'>
											<input type='hidden' name='voluntario' value='<?= $usuariologueado['usuario']?>'>
											<input type='submit' value='Asignarme esta tarea'>
										</form>
								<?php } ?>
					</div>
			<?php }
			} ?>
		</div>
		<div class="dia sabado">
			<h2>Día sábado</h2>
			<?php
			foreach ($actividades as $actividad) { 
				if ( $actividad->dia == "Sábado") { ?>
					<div class="card">
						<div class="carTitle">
							<h3><?=$actividad->nombre ?></h3>
							<h5>Categoria de la actividad: <?= $actividad->categoria ?></h5>
						</div>
						<p>Hora: <?= $actividad->hora ?></p>
						<p class="detalle">Detalle: <?= $actividad->detalle ?></p>
						<p>Voluntario asignado: <b><?= $actividad->voluntario ?></b> </p>
								<?php if ($usuariologueado['administrador'] === "1") { 
										$nombreMod= $actividad->nombre;
										$nombreMod = str_replace(" ","DeLtA",$nombreMod);?>
										<a class="accion" href='<?= DOMAIN?>/controlactividades/ver/<?=$nombreMod?>'>Editar</a>
										<form id="eliminar" action='<?=DOMAIN?>/controlactividades/eliminar' method='post'>
											<input type='hidden' name='nombre' value='<?= $actividad->nombre?>'>
											<input type='submit' value='Eliminar'>
										</form>
								<?php } else if ($actividad->voluntario == "") {?>
										<form action='<?=DOMAIN?>/controlactividades/asignar' method='post'>
											<input type='hidden' name='nombre' value='<?= $actividad->nombre?>'>
											<input type='hidden' name='voluntario' value='<?= $usuariologueado['usuario']?>'>
											<input type='submit' value='Asignarme esta tarea'>
										</form>
								<?php } ?>
					</div>
			<?php }
			} ?>
		</div>
		<div class="dia domingo">
			<h2>Día Domingo</h2>
			<?php
			foreach ($actividades as $actividad) { 
				if ( $actividad->dia == "Domingo") { ?>
					<div class="card">
						<div class="carTitle">
							<h3><?=$actividad->nombre ?></h3>
							<h5>Categoria de la actividad: <?= $actividad->categoria ?></h5>
						</div>
						<p>Hora: <?= $actividad->hora ?></p>
						<p class="detalle">Detalle: <?= $actividad->detalle ?></p>
						<p>Voluntario asignado: <b><?= $actividad->voluntario ?></b> </p>
								<?php if ($usuariologueado['administrador'] === "1") { 
										$nombreMod= $actividad->nombre;
										$nombreMod = str_replace(" ","DeLtA",$nombreMod);?>
										<a class="accion" href='<?= DOMAIN?>/controlactividades/ver/<?=$nombreMod?>'>Editar</a>
										<form id="eliminar" action='<?=DOMAIN?>/controlactividades/eliminar' method='post'>
											<input type='hidden' name='nombre' value='<?= $actividad->nombre?>'>
											<input type='submit' value='Eliminar'>
										</form>
								<?php } else if ($actividad->voluntario == "") {?>
										<form action='<?=DOMAIN?>/controlactividades/asignar' method='post'>
											<input type='hidden' name='nombre' value='<?= $actividad->nombre?>'>
											<input type='hidden' name='voluntario' value='<?= $usuariologueado['usuario']?>'>
											<input type='submit' value='Asignarme esta tarea'>
										</form>
								<?php } ?>
					</div>
			<?php }
			} ?>
		</div>
	</div>
	<p style="text-align: center;">2021 - CIPSA.net, Tésis Master en Programación Web, Ismael Ferreira, Centro Nou Barris - Creu Roja Barcelona</p>
	<script type="text/javascript">
		var arrayNoticias = document.querySelectorAll(".noticia");
		arrayNoticias[0].classList.add("noticiavista");

		var arrayNext = document.querySelectorAll(".control_next");
		var arrayPrev = document.querySelectorAll(".control_prev");

	  arrayNext.forEach(function(value) {
	    value.addEventListener("click", function() {
	      arrayNoticias.forEach(function(value) {
	        value.classList.remove("noticiavista");
	      });
	      var noticiaPadre = value.parentElement;
	      noticiaPadre.nextElementSibling.classList.add("noticiavista");
	    });
	  }); 
	  arrayPrev.forEach(function(value) {
	    value.addEventListener("click", function() {
	      arrayNoticias.forEach(function(value) {
	        value.classList.remove("noticiavista");
	      });
	      var noticiaPadre = value.parentElement;
	      noticiaPadre.previousElementSibling.classList.add("noticiavista");
	    });
	  });

	  window.setInterval(rotadorNoticias, 6000);

	function rotadorNoticias() {
	  var activo = document.querySelector(".noticiavista");
	  	if(activo.nextElementSibling) {
			activo.classList.remove("noticiavista");
			activo.nextElementSibling.classList.add("noticiavista");
		} else {
			activo.classList.remove("noticiavista");
			arrayNoticias[0].classList.add("noticiavista");
		}
	}


	</script>
</body>
</html>