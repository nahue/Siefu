<?php






require('DoctrineBootstrap.php');

// Autocarga las clases segun se las va necesitando
function miautoload($clase) {
	$archivo = "clases/$clase.class.php";
	
	if ($clase != "FirePHP")
	{
    	if (file_exists($archivo)) require_once $archivo;
	}
}
spl_autoload_register('miautoload');



$controlador = new Controlador();

//$perfil		= new Perfil();
$perfil = $controlador->get_perfil();
// SI EL USUARIO  ESTA LOGUEADO
if ($perfil->logueado()) {

	
	// SI SE ESPECIFICA UN MODULO ES USADO
	// SINO SE USA EL DEFINIDO POR DEFECTO EN config.inc.php
	if (isset($_GET["controlador"]) && $_GET["controlador"] != "")
	{
		$controladorID = $_GET["controlador"];
	}
	else 
		$controladorID = $config["controladorIndex"];

	// Carga el modulo que se le haya especificado
	// Por defecto carga el modulo "Principal"
	$controlador->cargar($controladorID);

} else {

	// Carga el modulo login
	$controlador->cargar("login");
}

if ($controlador->obtenerNombre() != "GenerarPDF")
{
    // Carga el Header
    require("templates/header.php");

    // Renderiza el modulo
    $controlador->mostrar();

    // Carga el footer
    require_once("templates/footer.php");
} else {
    
    // Renderiza el modulo
    $controlador->mostrar();
}