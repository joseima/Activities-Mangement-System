<?php
namespace Core;
defined("APPPATH") OR die("Access denied - App");
class App {
	private $_controller;
	private $_method = "index";
	private $_params = [];
	public function getController(){
		return $this->_controller;
	}
	public function getMethod(){
		return $this->_method;
	}
	public function getParams() {
		return $this->_params;
	}

	const NAMESPACE_CONTROLLERS = "\App\Controladores\\";
	const CONTROLLERS_PATH = "../App/controladores/";


	public static function getConfig() {
		return parse_ini_file(APPPATH . '/config/config.ini');
		echo "pasados datos de DB";
	}


	public function parseUrl() {
		if(isset($_GET["url"])) {
			return explode("/", filter_var(rtrim($_GET["url"], "/"), FILTER_SANITIZE_URL));
		}
	}
	public function __construct() {
		//obtenemos la url parseada
		$url = $this->parseUrl();
		// controlador y accion por defecto
		if ( $url == null) {
			$url[0] = "controlusuarios";
			$url[1] = "login";
		}
		var_dump($url);
		echo "<br>";
	//comprobamos que exista el archivo en el directorio controllers
		if(file_exists(self::CONTROLLERS_PATH.ucfirst($url[0]) . ".php")) {
			//nombre del archivo a llamar
			$this->_controller = ucfirst($url[0]);
			//eliminamos el controlador de url, así sólo nos quedaran el metodo

			unset($url[0]);

		} else {
			include APPPATH . "/vistas/errores/404.php";
			exit;
		}
		//obtenemos la clase con su espacio de nombres
		$fullClass = self::NAMESPACE_CONTROLLERS.$this->_controller;
		//asociamos la instancia a $this->_controller
		$this->_controller = new $fullClass;
		//si existe el segundo segmento comprobamos que el método exista en esa clase
		if(isset($url[1])) {
			//aquí tenemos el método
			$this->_method = $url[1];
			if(method_exists($this->_controller, $url[1])) {
				//eliminamos el método de url, así sólo quedan los parámetros del método
				unset($url[1]);
			} else {
				throw new \Exception("Controlador: {$fullClass} Metodo: {$this->_method} Desconocido", 1);
			}
		}
		//asociamos el resto de segmentos a $this->_params para pasarlos al método llamado.
		$this->_params = $url ? array_values($url) : [];
	}
	/**
	* [render lanzamos el controlador/método que se ha llamado con los parámetros]
	*/
	public function render() {
		call_user_func_array([$this->_controller, $this->_method], $this->_params);
	}
}