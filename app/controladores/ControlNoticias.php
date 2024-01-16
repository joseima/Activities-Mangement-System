<?php
namespace App\Controladores;
defined("APPPATH") OR die("Access denied");
use \Core\View;
use \App\Modelos\Actividades;
use \App\Entidades\Actividad;
use \App\Modelos\Noticias;
use \App\Entidades\Noticia;

class ControlNoticias{


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
		'titulo'=> '',
		'texto' => '',
		'fecha' => '' ]);

		View::render("nuevanot");
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
		$titulo = filter_input(INPUT_POST, "titulo");
		Noticias::delete($titulo);
		View::set("error",[
			'mensaje'=> 'Haz eliminado la noticia',
			'nombre' => '',
			'clave' => ''
		]);
		ControlActividades::listar();
	}

	public function insertar() {
		$titulo = filter_input(INPUT_POST, "titulo");
		$texto = filter_input(INPUT_POST, "texto");
		$fecha = filter_input(INPUT_POST, "fecha");
		
		$nueva_noticia = new Noticia($titulo, $texto, $fecha);
			var_dump($nueva_noticia);
			Noticias::insert($nueva_noticia);
			ControlActividades::listar();
	}



	
}