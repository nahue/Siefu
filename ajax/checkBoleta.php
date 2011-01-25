<?php
require("../config.inc.php");
require("../DoctrineBootstrap.php");
$boleta = $_GET["boleta"];

$checkBoleta = Doctrine_Core::getTable("DetalleTramite")->findOneByBoletaPrenumerada($boleta);
if ($checkBoleta)
{
    $datos["boleta_prenumerada"] = "Boleta prenumerada existente";
    echo json_encode($datos);
}
else
    echo "true";

//echo "true";