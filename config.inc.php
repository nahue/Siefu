<?php



// OPCIONES DE TRAMITES

$opciones = array(
    "cambioDomicilio",
    "actualizacionMayor16",
    "reposicion",
    "identificacion",
    "rectificacion",
    "nuevoEjemplar",
    "prorroga",
    "actualizacionMenor",
    "nuevaTarjeta",
    "cambioCategoria");

// FIN OPCIONES DE TRAMITES

$config["debug"] = true;
$config["mail"]["SMTPDebug"] = 0;
$config["mail"]["host"] = "masters.tierradelfuego.gov.ar";
$config["mail"]["user"] = "webtdf@tierradelfuego.gov.ar";
$config["mail"]["pass"] = "Tdf529gob";
$config["mail"]["correoOrigen"] = "siefu@tierradelfuego.gov.ar";
$config["mail"]["correoDestino"] = 'nchavez@tierradelfuego.gov.ar';
$config["mail"]["nombreDestino"] = 'Nahuel Chaves';
$config["mail"]["asunto"] = 'Formulario de Consulta - SIEFU';
$config["mail"]["textoAlternativo"] = 'Para ver el mensaje necesita un cliente de correo que soporte HTML!';
if ($_SERVER["SERVER_ADDR"] == "10.1.9.236" || $_SERVER["SERVER_ADDR"] == "10.1.9.120")
	$config["db"]["dsn"] = 'mysql://root:strato1986@localhost/siefu';
else
        $config["db"]["dsn"] = 'mysql://root:strato1986@localhost/siefu;unix_socket=/var/run/mysqld/mysqld.sock';

$config["controladorIndex"] = "principal";




?>
