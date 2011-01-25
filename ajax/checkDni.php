<?php

require("../config.inc.php");
require("../DoctrineBootstrap.php");
$dni = $_POST["dni"];
$checkExtranjero = isset($_POST["checkExtranjero"]) ? 1 : null;

$entes = Doctrine_Core::getTable('Ente');
$entes = $entes->findByDni($dni);


    
    
    if ($entes->count())
    {
        
        if ($checkExtranjero)
        {
            $a = $entes->toArray();
            if (isset($a["extranjero"]) && $a["extranjero"] != NULL)
            {
                $respuesta['respuesta'] = true;
            } else {
                $respuesta['respuesta'] = "El ente ingresado no es extranjero";

            }
        } else
            $respuesta['respuesta'] = true;

    }
    else
    {
        $respuesta['respuesta'] = false;
    }
    echo json_encode($respuesta);
    

?>
