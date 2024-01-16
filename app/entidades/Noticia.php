<?php
namespace App\Entidades;
defined("APPPATH") OR die("Access denied - noticia");

class Noticia {
	public $titulo;
	public $texto;
	public $fecha;


	public function __construct( $_titulo, $_texto, $_fecha ) {
		$this->titulo = $_titulo;
		$this->texto = $_texto;
		$this->fecha = $_fecha;

	}
}