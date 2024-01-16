<?php
namespace App\Entidades;
defined("APPPATH") OR die("Access denied - usuario");

class Usuario {
	public $nombre;
	public $clave;
	public $administrador;
	public $mail;
	public $telefono;
	public $activo;
	//public $sesion = 0;

	public function __construct( $_nombre, $_clave, $_administrador, $_activo, $_mail, $_telefono/*, $_sesion*/ ) {
		$this->nombre = $_nombre;
		$this->clave = $_clave;
		$this->administrador = $_administrador;
		$this->activo = $_activo;
		$this->mail = $_mail;
		$this->telefono = $_telefono;
		//$this->sesion = $_sesion;
	}
}