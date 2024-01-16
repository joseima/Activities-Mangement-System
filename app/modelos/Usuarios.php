<?php
namespace App\Modelos;
defined("APPPATH") OR die("Access denied");
use \Core\Database;
use \App\Entidades\Usuario;
use \App\Interfaces\Crud;

class Usuarios /*implements Crud*/ {
	public static function getAll() {
		$usuarios = array();
		try {
			$db = Database::instance();
			$sql = "SELECT * from usuarios";
			$query = $db->run($sql);
			// Bucle de obtención de resultados
			while ( $reg = $query->fetch() ) {
			// Creacion de objeto Usuario por cada registro y agregado
			// a matriz de resultados
			array_push($usuarios,
			new Usuario($reg['usuario'],
						$reg['clave'],
						$reg['administrador'],
						$reg['activo'],
						$reg['mail'],
						$reg['telefono']));
			}
			return $usuarios;
		} catch(\PDOException $e) {
			print "Error!: " . $e->getMessage();
		}
	}

	public static function getById($id) {
		echo("<br>$id<br>");
		try {
			$db = Database::instance();
			$sql = "SELECT * from usuarios WHERE usuario LIKE :usuario";
			$query = $db->run($sql, [':usuario' => $id]);
			$reg = $query->fetch();
			return ( ($reg)?
				// Retorno del objeto Usuario recuperado
				new Usuario($reg['usuario'],
				$reg['clave'],
				$reg['administrador'],
				$reg['activo'],
				$reg['mail'],
				$reg['telefono'])

				// Retorno NULL si no se recuperó ningún registro
				:NULL );
		} catch(\PDOException $e) {
			print "Error!: " . $e->getMessage();
		}
	}

	public static function insert($user) {
		try {
			$db = Database::instance();
			$sql = "INSERT INTO usuarios( usuario, clave, administrador, activo, mail, telefono )
			VALUES ( :usuario, :clave, :admin, :activo, :mail, :telefono )";
			$query = $db->run($sql, [':usuario' => $user->nombre,
				':clave' => $user->clave,
				':admin' => $user->administrador,
				':activo' => $user->activo,
				':mail' => $user->mail,
				':telefono' => $user->telefono ]);

		} catch(\PDOException $e) {
			print "Error!: " . $e->getMessage();
		}
	}

	public static function update($user) {
		try {
			$db = Database::instance();
			$sql = "UPDATE usuarios SET clave = :clave,
				administrador = :admin,
				activo = :activo,
				mail = :mail,
				telefono = :telefono
				WHERE usuario = :usuario";
			$query = $db->run($sql, [':usuario' => $user->nombre,
				':clave' => $user->clave,
				':admin' => $user->administrador,
				':activo' => $user->activo,
				':mail' => $user->mail,
				':telefono' => $user->telefono ]);
		}catch(\PDOException $e) {
			print "Error!: " . $e->getMessage();
		}
	}

	public static function delete($id) {
		try {
			$db = Database::instance();
			$sql = "DELETE FROM usuarios WHERE usuario = :usuario";
			$query = $db->run($sql, [':usuario' => $id]);
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
}