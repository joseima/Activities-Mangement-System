<?php
namespace App\Controladores;
defined("APPPATH") OR die("Access denied");
use \Core\View;
use \App\Modelos\Usuarios;
use \App\Entidades\Usuario;
use \App\Modelos\Actividades;
use \App\Entidades\Actividad;
use \App\Modelos\Noticias;
use \App\Entidades\Noticia;

class ControlActividades{

	public function listar() {
		$actividades = Actividades::getAll();
		View::set("actividades", $actividades);
		View::render("panel");
	}


	public function ver( $nombre ) {
		echo("<br>$nombre<br>");
		$nombre = str_replace("DeLtA"," ",$nombre);
		echo("<br>$nombre<br>");
		$actividad = Actividades::getById($nombre);
		var_dump($actividad);
		View::set("actividad", $actividad);
		View::render("ediactiv");
	}

	public function nuevo () {
		View::set("error",[
		'mensaje'=> '',
		'nombre' => '',
		'categoria' => '',
		'dia' => '',
		'hora' => 0,
		'detalle' => '',
		'voluntario' => '' ]);

		View::render("nuevactiv");
	}

	public function actualizar() {
		$nombre = filter_input(INPUT_POST, "nombre");
		$nuevonombre = filter_input(INPUT_POST, "nuevonombre");
		$categoria = filter_input(INPUT_POST, "categoria");
		$dia = filter_input(INPUT_POST, "dia");
		$hora = filter_input(INPUT_POST, "hora");
		$detalle = filter_input(INPUT_POST, "detalle");
		$voluntario = filter_input(INPUT_POST, "voluntario");
		$actividad = new Actividad($nombre, $categoria, $dia, $hora, $detalle, $voluntario);
		echo("<br>el nobre viejo es: $nombre<br>");
		var_dump($actividad);
		echo("<br>$nuevonombre<br>");
		Actividades::update($actividad, $nuevonombre);
		$this->listar();
	}

	public function eliminar() {
		$nombre = filter_input(INPUT_POST, "nombre");
		Actividades::delete($nombre);
		View::set("error",[
			'mensaje'=> 'Haz eliminado la tarea',
			'nombre' => '',
			'clave' => ''
		]);
		$this->listar();
	}

	public function insertar() {
		$nombre = filter_input(INPUT_POST, "nombre");
		$categoria = filter_input(INPUT_POST, "categoria");
		$dia = filter_input(INPUT_POST, "dia");
		$hora = filter_input(INPUT_POST, "hora");
		$detalle = filter_input(INPUT_POST, "detalle");
		$voluntario = filter_input(INPUT_POST, "voluntario");
		
		$nueva_actividad = new Actividad($nombre, $categoria, $dia, $hora, $detalle, $voluntario);
			var_dump($nueva_actividad);
			Actividades::insert($nueva_actividad);
			$this->listar();
	}

	public function asignar() {
		$nombre = filter_input(INPUT_POST, "nombre");
		$voluntario = filter_input(INPUT_POST, "voluntario");
		Actividades::asignar($nombre, $voluntario);
		View::set("error",[
			'mensaje'=> 'Te has asignado la tarea',
			'nombre' => '',
			'clave' => ''
		]);
		$this->listar();
	}

	
}