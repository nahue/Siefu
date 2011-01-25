<?php

ob_start();
session_start();
date_default_timezone_set('America/Argentina/Ushuaia');
require_once("clases/Html.class.php");
define('DS', DIRECTORY_SEPARATOR);
if ($_SERVER["SERVER_ADDR"] != "10.1.9.236")
    define( 'ROOT_URL', Html::obtenerUrl().'/siefu' );
else
    define( 'ROOT_URL', Html::obtenerUrl() );
define('RUTA', dirname(__FILE__));
define('RUTA_TPL', RUTA . DS . "templates");
define('TITULO', 'S.I.E.F.U');

// Importar configuraciones
require_once("config.inc.php");

// Importar clase en caso de requerir DEBUG
if ($_SERVER["SERVER_ADDR"] != "10.1.9.236")
{
    require('FirePHPCore/fb.php');

    error_reporting(E_ALL);
    ini_set("display_errors", 1);

}

// Inicializar componentes
require_once("init.php");



?>