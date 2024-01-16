<?php
namespace App\Entidades;
defined("APPPATH") OR die("Access denied - tarea");

class Actividad {
	public $nombre;
	public $categoria;
	public $dia;
	public $hora;
	public $detalle;
	public $voluntario;
	//public $sesion = 0;

	public function __construct( $_nombre, $_categoria, $_dia, $_hora, $_detalle, $_voluntario/*, $_sesion*/ ) {
		$this->nombre = $_nombre;
		$this->categoria = $_categoria;
		$this->dia = $_dia;
		$this->hora = $_hora;
		$this->detalle = $_detalle;
		$this->voluntario = $_voluntario;
		//$this->sesion = $_sesion;
	}
}