<?php

// Importar clase en caso de requerir DEBUG
//if ($config["debug"]) {
    require('../FirePHPCore/fb.php');

    error_reporting(E_ALL);
    ini_set("display_errors", 1);

//}


require_once("../config.inc.php");
require_once("../DoctrineBootstrap.php");
require_once("../clases/Crypt.class.php");
require_once("../clases/Controlador.class.php");
require_once("../clases/Perfil.class.php");

try {
    $usuario = new Usuario();
    $usuario->nombre = $_POST["nombre"];
    $usuario->usuario = $_POST["usuario"];
    $usuario->apellido = $_POST["apellido"];
    $usuario->email = $_POST["email"];
    $usuario->Entidad_id = $_POST["entidad_id"];
    $claveAleatoria = Crypt::claveAleatoria();
    $usuario->pass = $claveAleatoria;

    $perfil = new Perfil();

    if ($perfil->notificarUsuario($_POST["email"],$_POST["nombre"], $claveAleatoria))
        $usuario->save();
} catch (Exception $exc) {
    echo "Error: ".$exc->getTraceAsString();
}




