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
	<h1>AUTENTIFICACION</h1>
	<h2 style='background-color: #ff0000'><?= $error['mensaje']?>
	</h2>
	<form action='<?= DOMAIN?>/controlusuarios/autentificar' method='post'>
		Usuario: <input type='text' name='nombre' value='<?= $error['nombre']?>'>
		Clave: <input type='password' name='clave' value='<?= $error['clave']?>'><br/>
		<input type='submit' value='Ingresar'>
	</form>
</div>
</body>
</html>