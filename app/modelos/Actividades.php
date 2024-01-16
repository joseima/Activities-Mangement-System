<?php
namespace App\Modelos;
defined("APPPATH") OR die("Access denied");
use \Core\Database;
use \App\Entidades\Actividad;
use \App\Entidades\Noticia;
use \App\Interfaces\Crud;

class Actividades /*implements Crud*/ {
	public static function getAll() {
		echo "<br>estoy en get all<br>";
		$actividades = array();
		$noticias = array();
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

			$db2 = Database::instance();
			$sql2 = "SELECT * from noticias";
			$query2 = $db2->run($sql2);

			while ( $reg = $query2->fetch() ) {
			array_push($noticias,
			new Noticia($reg['titulo'],
						$reg['texto'],
						$reg['fecha']));
			}
			
			array_push($actividades, $noticias);
			var_dump($actividades);
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

	public static function insert($actividad) {
		try {
			$db = Database::instance();
			$sql = "INSERT INTO actividades( nombre, categoria, dia, hora, detalle, voluntario )
			VALUES ( :nombre, :categoria, :dia, :hora, :detalle, :voluntario )";
			$query = $db->run($sql, [':nombre' => $actividad->nombre,
				':categoria' => $actividad->categoria,
				':dia' => $actividad->dia,
				':hora' => $actividad->hora,
				':detalle' => $actividad->detalle,
				':voluntario' => $actividad->voluntario ]);

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

	public static function delete($actividad) {
		try {
			$db = Database::instance();
			$sql = "DELETE FROM actividades WHERE nombre = :nombre";
			$query = $db->run($sql, [':nombre' => $actividad]);
		}
		catch(\PDOException $e)
		{
			print "Error!: " . $e->getMessage();
		}
	}

	public static function verify($id, $clave) {
		echo $id.'<br>';
		echo $clave.'<br>';
		try {
			$db = Database::instance();
			$sql = "SELECT * from usuarios WHERE usuario LIKE :usuario AND clave LIKE :clave";
			$query = $db->run($sql, [':usuario' => $id,
				':clave' => $clave]);
			$reg = $query->fetch();
			var_dump($reg['usuario']);
			return ( ($reg)?
				// Retorno del objeto Usuario recuperado
				/*new Usuario($reg['usuario'],
				$reg['clave'],
				$reg['administrador'],
				$reg['activo'])*/
				$reg
				// Retorno NULL si no se recuperó ningún registro
				:NULL );
		} catch(\PDOException $e) {
			print "Error!: " . $e->getMessage();
		}
	}

	public static function asignar($nombre, $voluntario) {
		try {
			$db = Database::instance();
			$sql = "UPDATE actividades SET 
				voluntario = :voluntario
				WHERE nombre = :nombre";
			$query = $db->run($sql, [ 
				':nombre' => $nombre,
				':voluntario' => $voluntario ]);
		}catch(\PDOException $e) {
			print "Error!: " . $e->getMessage();
		}
	}
}