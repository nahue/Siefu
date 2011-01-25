<?php 

// bootstrap.php
/**
 * Bootstrap Doctrine.php, register autoloader specify
 * configuration attributes and load models.
 */
require_once('config.inc.php');
require_once('DoctrineBootstrap.php');
require('FirePHPCore/fb.php');
require('clases/Bd.class.php');


function createRandomPassword() {



    $chars = "abcdefghijkmnopqrstuvwxyzABCDEFGHIJKMNLOPQRSTUVXWYZ023456789";

    srand((double)microtime()*1000000);

    $i = 0;

    $pass = '' ;



    while ($i <= 10) {

        $num = rand() % 33;

        $tmp = substr($chars, $num, 1);

        $pass = $pass . $tmp;

        $i++;

    }



    return $pass;



}



// Usage

$password = createRandomPassword();

echo "Your random password is: $password <br />";




$q = Doctrine_Query::create()
                ->select("d.*, l.*, c.*, p.*, partido.*")
                ->from("Domicilio d, d.Localidad l, d.Calle c, d.Provincia p, d.PartidoDepto partido")
                ->where("d.ente_id = ?", "32135988")
                ->orderBy("d.id DESC");

$domicilioAnterior = $q->execute()->get(1);
if($domicilioAnterior->exists())
        echo "existe";
else
    echo "no existe";


fb::log($domicilioAnterior);
?>