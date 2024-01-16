<?php
namespace App\Controladores;
defined("APPPATH") OR die("Access denied");
use \Core\View;
use \App\Modelos\Usuarios;
use \App\Entidades\Usuario;
use \App\Modelos\Actividades;
use \App\Entidades\Actividad;

class ControlUsuarios {

	public function listar() {
		$users = Usuarios::getAll();
		View::set("users", $users);
		View::render("lista");
	}


	public function ver( $nombre ) {
		$nombre = str_replace("DeLtA"," ",$nombre);
		echo("<br>$nombre<br>");
		$user = Usuarios::getById($nombre);
		View::set("user", $user);
		View::render("edicion");
	}

	public function nuevo() {
		View::set("error",[
		'mensaje'=> '',
		'nombre' => '',
		'clave' => '',
		'administrador' => 0,
		'activo' => 0 ]);

		View::render("nuevo");
	}

	public function actualizar() {
		$nombre = filter_input(INPUT_POST, "usuario");
		$clave = filter_input(INPUT_POST, "clave");
		$mail = filter_input(INPUT_POST, "mail");
		$telefono = filter_input(INPUT_POST, "telefono");
		$administrador = isset($_POST['administrador'])?1:0;
		$activo = isset($_POST['activo'])?1:0;
		$usuario = new Usuario($nombre, $clave, $administrador, $activo, $mail, $telefono);
		Usuarios::update($usuario);
		$this->listar();
	}

	public function eliminar() {
		$nombre = filter_input(INPUT_POST, "usuario");
		Usuarios::delete($nombre);
		$this->listar();
	}

	public function insertar() {
		$nombre = filter_input(INPUT_POST, "usuario");
		$clave = filter_input(INPUT_POST, "clave");
		$mail = filter_input(INPUT_POST, "mail");
		$telefono = filter_input(INPUT_POST, "telefono");
		$administrador = isset($_POST['administrador'])?1:0;
		$activo = isset($_POST['activo'])?1:0;
		// Comprobacion de usuario existente?
		$usuario_existente = Usuarios::getById($nombre);
		
		if ( $usuario_existente == NULL ) {
			echo("<br>$administrador<br>");
			$nuevo_usuario = new Usuario($nombre, $clave, $administrador, $activo, $mail, $telefono);
			var_dump($nuevo_usuario);
			Usuarios::insert($nuevo_usuario);
			$this->listar();
		} else {
			// Usuario ya existe -> ERROR.
			View::set("error",[
			'mensaje'=> "Usuario $nombre ya existe",
			'nombre' => $nombre,
			'clave' => $clave,
			'mail' => $mail,
			'telefono' => $telefono,
			'administrador' => $administrador,
			'activo' => $activo ]);

			View::render("nuevo");
		}
	}

	/* LOGIN
		**Carga de formulario de lgoin
	*/
	public function login() {
		View::set("error",[
			'mensaje'=> '',
			'nombre' => '',
			'clave' => ''
		]);

		View::render("login");
	}

	public function autentificar() {
		$nombre = filter_input(INPUT_POST, "nombre");
		$clave = filter_input(INPUT_POST, "clave");
		echo $sesion.'<br>';
		// Comprobacion de usuario y contraseña
		$usuario_correcto = Usuarios::verify($nombre, $clave);
		
		if ( $usuario_correcto == NULL ) {
			// Usuario o Clave incorrecta.
			View::set("error", ['mensaje' => 'Usuario o contraseña incorrectos',
			'nombre' => $nombre,
			'clave' => $clave]);
			View::render("login");
		} else {
			// Usuario y contraseña correctos
			//$sesion_usuario = new Usuario($usuario_correcto[0], $usuario_correcto[1],$usuario_correcto[2],$usuario_correcto[3]);
			var_dump($usuario_correcto);
			$_SESSION['usuario'] = $usuario_correcto;
			/*Usuarios::insert($nuevo_usuario);*/
			//$this->listar();
			ControlActividades::listar();
		}
	}
	public function cerrarsesion() {
		$_SESSION['usuario']  = NULL;
		View::set("error",[
			'mensaje'=> 'Haz finalizado sesión',
			'nombre' => '',
			'clave' => ''
		]);

		View::render("login");
	}
}