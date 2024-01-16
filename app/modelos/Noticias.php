<?php
namespace App\Modelos;
defined("APPPATH") OR die("Access denied");
use \Core\Database;
use \App\Entidades\Noticia;
use \App\Interfaces\Crud;

class Noticias /*implements Crud*/ {
	public static function getAll() {
		$actividades = array();
		try {
			$db = Database::instance();
			$sql = "SELECT * from actividades";
			$query = $db->run($sql);

			while ( $reg = $query->fetch() ) {

			array_push($actividades,
			new Actividad($reg['nombre'],
						$reg['categoria'],
						$reg['dia'],
						$reg['hora'],
						$reg['detalle'],
						$reg['voluntario']));
			}
			return $actividades;
		} catch(\PDOException $e) {
			print "Error!: " . $e->getMessage();
		}
	}

	public static function getById($id) {
		echo("<br>$id<br>");
		try {
			$db = Database::instance();
			$sql = "SELECT * from actividades WHERE nombre LIKE :nombre";
			$query = $db->run($sql, [':nombre' => $id]);
			$reg = $query->fetch();
			return ( ($reg)?
				
				new Actividad($reg['nombre'],
				$reg['categoria'],
				$reg['dia'],
				$reg['hora'],
				$reg['detalle'],
				$reg['voluntario'])

				
				:NULL );
		} catch(\PDOException $e) {
			print "Error!: " . $e->getMessage();
		}
	}

	public static function insert($noticia) {
		try {
			$db = Database::instance();
			$sql = "INSERT INTO noticias( titulo, texto, fecha )
			VALUES ( :titulo, :texto, :fecha )";
			$query = $db->run($sql, [':titulo' => $noticia->titulo,
				':texto' => $noticia->texto,
				':fecha' => $noticia->fecha ]);

		} catch(\PDOException $e) {
			print "Error!: " . $e->getMessage();
		}
	}

	public static function update($actividad, $nuevonombre) {
		try {
			$db = Database::instance();
			$sql = "UPDATE actividades SET nombre = :nuevonombre,
				categoria = :categoria,
				dia = :dia,
				hora = :hora,
				detalle = :detalle,
				voluntario = :voluntario
				WHERE nombre = :nombre";
			$query = $db->run($sql, [ ':nuevonombre' => $nuevonombre,
				':nombre' => $actividad->nombre,
				':categoria' => $actividad->categoria,
				':dia' => $actividad->dia,
				':hora' => $actividad->hora,
				':detalle' => $actividad->detalle,
				':voluntario' => $actividad->voluntario ]);
		}catch(\PDOException $e) {
			print "Error!: " . $e->getMessage();
		}
	}

	public static function delete($noticia) {
		try {
			$db = Database::instance();
			$sql = "DELETE FROM noticias WHERE titulo = :titulo";
			$query = $db->run($sql, [':titulo' => $noticia]);
		}
		catch(\PDOException $e)
		{
			print "Error!: " . $e->getMessage();
		}
	}



}