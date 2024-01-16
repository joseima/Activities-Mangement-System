<?php
session_start();

define("DOMAIN", "/VoluntariosCR/public");
echo "Domain:".DOMAIN."<br>";
define("JS_SCRIPTS", "/VoluntariosCR/app/scripts");
echo "scripts:".JS_SCRIPTS."<br>";
define("CSS", "/VoluntariosCR/app/css");
define("PROJECTPATH", dirname(__DIR__));
echo "Project path:".PROJECTPATH."<br>";

define("APPPATH", PROJECTPATH . '/App');
echo "App path:".APPPATH."<br>";


//try {
	function autoload_classes($class_name) {
		echo "la clase se ha llamado a autoload:".$class_name."<br>";
		$filename = PROJECTPATH . '/' . str_replace('\\', '/', $class_name) .'.php';
		echo "Cargando:".$filename."<br>";
		if(is_file($filename)) {
			include_once $filename;
			echo "clase:".$class_name." CARGADA<br>";
		}
	}
/*}
	catch(Exception $e)
{
	print "Error!: " . $e->getMessage();
}
*/

spl_autoload_register('autoload_classes');

$app = new \Core\App;
$app->render();