<?php
require("../config.inc.php");
require('../DoctrineBootstrap.php');

$nombreTabla = explode("_", $_GET["id"]);

if ($nombreTabla[0] == "partido")
    $tabla = "partidoDepto";
else
    $tabla = $nombreTabla[0];

$q = Doctrine_Query::create()
    ->from(ucfirst($tabla). " t")
    ->where("t.descripcion LIKE ?",$_GET["term"]."%");

$tabla = $q->execute();
//$tabla = Doctrine_Core::getTable(ucfirst($nombreTabla[0]))->findAll();

$array = array();

foreach ($tabla->toArray() as $t) {
    $array[] = $t["descripcion"];
}


echo json_encode($array);