<?php

//if (!isset($_SERVER['HTTP_REFERER']))
//    die ("No puede acceder directamente a este modulo");
//$enteTabla = Doctrine_Core::getTable('Ente')->findOneByDni($_SESSION['datosTramite']['dni'])->toArray();

$q = Doctrine_Query::create()
                ->select("e.*, s.*, p.*, prov_naci.*, loca_naci.*, partido_naci.*, estado.*")
                ->from("Ente e, e.Sexo s, e.Pais p,
        e.provincia_nacimiento prov_naci,
        e.localidad_nacimiento loca_naci,
        e.partido_nacimiento partido_naci,
        e.EstadoCivil estado")
                ->where("e.dni = ?", $_SESSION["datosTramite"]["dni"]);

$enteTabla = $q->execute()->get(0)->toArray();

$fecha_nacimiento = explode("/", Bd::FechaMysqlaFecha($enteTabla["fecha_nacimiento"]));


$Ente = array(
    'dni' => $enteTabla["dni"],
    'apellido' => utf8_decode($enteTabla["apellido"]),
    'nombre' => utf8_decode($enteTabla["nombre"]),
    'fecha_nacimiento' => array(
        'dia' => $fecha_nacimiento[0],
        'mes' => $fecha_nacimiento[1],
        'anio' => $fecha_nacimiento[2]
    ),
    'sexo' => $enteTabla["Sexo"]["descripcion"],
    'pais' => utf8_decode($enteTabla["Pais"]["descripcion"]),
    'provincia_nacimiento' => utf8_decode($enteTabla["provincia_nacimiento"]["descripcion"]),
    'partido_nacimiento' => utf8_decode($enteTabla["partido_nacimiento"]["descripcion"]),
    'localidad_nacimiento' => utf8_decode($enteTabla["localidad_nacimiento"]["descripcion"]),
    'estado_civil' => $enteTabla["EstadoCivil"]["descripcion"],
    'veterano' => $enteTabla["veterano"]
);


$q = Doctrine_Query::create()
                ->select("d.*, l.*, c.*, p.*, partido.*")
                ->from("Domicilio d, d.Localidad l, d.Calle c, d.Provincia p, d.PartidoDepto partido")
                ->where("d.ente_id = ?", $enteTabla["id"])
                ->orderBy("d.id DESC");


$domicilioActual = $q->execute()->get(0)->toArray();
$domicilioAnterior = $q->execute()->get(1);
$telefono = explode(" ", $domicilioActual["telefono"]);

$DomicilioActual = array(
    "Provincia" => utf8_decode($domicilioActual["Provincia"]["descripcion"]),
    "Localidad" => utf8_decode($domicilioActual["Localidad"]["descripcion"]),
    "PartidoDepto" => utf8_decode($domicilioActual["PartidoDepto"]["descripcion"]),
    "Calle" => utf8_decode($domicilioActual["Calle"]["descripcion"]),
    'barrio' => utf8_decode($domicilioActual["barrio"]),
    'nro_calle' => $domicilioActual["nro_calle"],
    'piso' => $domicilioActual['piso'],
    'depto' => $domicilioActual['depto'],
    'cod_postal' => $domicilioActual['cod_postal'],
    'tel_prefijo' => str_replace(array("(", ")"), "", $telefono[0]),
    'tel_numero' => $telefono[1]
);
if($domicilioAnterior->exists())
{
        $domicilioAnteriorArray = $domicilioAnterior->toArray();
    $DomicilioAnterior = array(
        "Provincia" => utf8_decode($domicilioAnteriorArray["Provincia"]["descripcion"]),
        "Localidad" => utf8_decode($domicilioAnteriorArray["Localidad"]["descripcion"]),
        "PartidoDepto" => utf8_decode($domicilioAnteriorArray["PartidoDepto"]["descripcion"]),
        "Calle" => utf8_decode($domicilioAnteriorArray["Calle"]["descripcion"]),
        'barrio' => utf8_decode($domicilioAnteriorArray["barrio"]),
        'nro_calle' => $domicilioAnteriorArray["nro_calle"],
        'piso' => $domicilioAnteriorArray['piso'],
        'depto' => $domicilioAnteriorArray['depto'],
        'cod_postal' => $domicilioAnteriorArray['cod_postal'],
        'tel_prefijo' => str_replace(array("(", ")"), "", $telefono[0]),
        'tel_numero' => $telefono[1]
    );
}
$q = Doctrine_Query::create()
                ->select("dato.*, detalle.*")
                ->from("DatoTramite dato, dato.DetalleTramite detalle")
                ->where("detalle.boleta_prenumerada = ?", $_SESSION["datosTramite"]["boleta"]);

$tramite = $q->execute()->get(0)->toArray();

$fechatramite = explode("/", Bd::FechaMysqlaFecha($tramite["fecha"]));

$tramite["fecha_dia"] = $fechatramite[0];
$tramite["fecha_mes"] = $fechatramite[1];
$tramite["fecha_anio"] = $fechatramite[2];

$q = Doctrine_Query::create()
                ->select("e.*, c.*")
                ->from("Educacional e, e.Carrera c")
                ->where("e.Ente.id = ?", $enteTabla["id"]);

$educacionalTabla = $q->execute()->get(0)->toArray();

if ($educacionalTabla["lee_escribe"] == 1)
    $educacionalTabla["lee_escribe"] = "Si";
else
    $educacionalTabla["lee_escribe"] = "No";

$Educacional = array(
    "lee_escribe" => $educacionalTabla["lee_escribe"],
    "mas_nivel_educacional" => utf8_decode($educacionalTabla["mas_nivel_educacional"]),
    "titulo_alcanzado" => utf8_decode($educacionalTabla["Carrera"]["descripcion"]),
    "titulo_posgrado" => utf8_decode($educacionalTabla["titulo_posgrado"]),
    "profesion" => utf8_decode($educacionalTabla["profesion"]),
    "ocupacion" => utf8_decode($educacionalTabla["ocupacion"]),
    "cambios" => utf8_decode($educacionalTabla["cambios"])
);


$pdf = new FPDF();
$pdf->SetMargins(0, 0);
$pdf->AddPage('P', 'Legal');
$pdf->SetFont('Arial', '', 10);
$pdf->setXY(30, 12);
$pdf->Write(10, $Ente["dni"]);

$pdf->setXY(105, 12);
$pdf->Write(10, $Ente["apellido"]);
$pdf->setXY(17, 19);
$pdf->Write(10, $fecha_nacimiento[2]);
$pdf->setXY(45, 19);
$pdf->Write(10, $Ente["sexo"]);
$pdf->setXY(78, 19);
$pdf->Write(10, $Ente["nombre"]);
$pdf->setXY(18, 39);
$pdf->Write(10, $Ente["fecha_nacimiento"]["dia"]);
$pdf->setXY(27, 39);
$pdf->Write(10, $Ente["fecha_nacimiento"]["mes"]);
$pdf->setXY(35, 39);
$pdf->Write(10, $Ente["fecha_nacimiento"]["anio"]);
$pdf->setXY(20, 46);
$pdf->Write(10, $Ente["pais"]);
$pdf->setXY(26, 53);
$pdf->Write(10, $Ente["provincia_nacimiento"]);
$pdf->setXY(26, 60);
$pdf->Write(10, $Ente["partido_nacimiento"]);
$pdf->setXY(24, 67);
$pdf->Write(10, $Ente["localidad_nacimiento"]);
$pdf->setXY(27, 75);
$pdf->Write(10, $Ente["estado_civil"]);
$pdf->setXY(45, 130);
$pdf->Write(10, $tramite["DetalleTramite"]["boleta_prenumerada"]);
$pdf->setXY(169, 130);
$pdf->Write(10, $tramite["fecha_dia"]);
$pdf->setXY(181, 130);
$pdf->Write(10, $tramite["fecha_mes"]);
$pdf->setXY(193, 130);
$pdf->Write(10, $tramite["fecha_anio"]);
$pdf->setXY(28, 138);
$pdf->Write(10, $tramite["id_oficina_seccional"]);
$pdf->setXY(92, 138);
$pdf->Write(10, $tramite["oficina_seccion"]);
$pdf->setXY(40, 146);
$pdf->Write(10, $Ente["apellido"]);
$pdf->setXY(41, 154);
$pdf->Write(10, $Ente["nombre"]);
$pdf->setXY(169, 154);
$pdf->Write(10, $Ente["dni"]);
$pdf->setXY(69, 162);
if ($Ente["veterano"] == "")
    $pdf->Write(10, "No");
else
    $pdf->Write(10, "Si");
$pdf->setXY(67, 178);
$pdf->Write(10, $DomicilioActual["Provincia"]);
$pdf->setXY(29, 186);
$pdf->Write(10, $DomicilioActual["PartidoDepto"]);
$pdf->setXY(121, 186);
$pdf->Write(10, $DomicilioActual["Localidad"]);
$pdf->setXY(55, 194);
$pdf->Write(10, $DomicilioActual["barrio"]);
$pdf->setXY(19, 202);
$pdf->Write(10, $DomicilioActual["Calle"]);
$pdf->setXY(178, 202);
$pdf->Write(10, $DomicilioActual["nro_calle"]);
$pdf->setXY(17, 211);
$pdf->Write(10, $DomicilioActual["piso"]);
$pdf->setXY(49, 211);
$pdf->Write(10, $DomicilioActual["depto"]);
$pdf->setXY(91, 211);
$pdf->Write(10, $DomicilioActual["cod_postal"]);
$pdf->setXY(140, 211);
$pdf->Write(10, $DomicilioActual["tel_prefijo"]);
$pdf->setXY(157, 211);
$pdf->Write(10, $DomicilioActual["tel_numero"]);
$pdf->setXY(41, 233);
$pdf->Write(10, $Educacional["lee_escribe"]);
$pdf->setXY(102, 233);
$pdf->Write(10, $Educacional["mas_nivel_educacional"]);
$pdf->setXY(36, 241);
$pdf->Write(10, $Educacional["titulo_alcanzado"]);
$pdf->setXY(45, 249);
$pdf->Write(10, $Educacional["titulo_posgrado"]);
$pdf->setXY(38, 257);
$pdf->Write(10, $Educacional["profesion"]);
$pdf->setXY(136, 257);
$pdf->Write(10, $Educacional["ocupacion"]);
$pdf->setXY(23, 265);
$pdf->Write(10, $Educacional["cambios"]);
$pdf->SetFont('Arial', '', 7);
$pdf->setXY(174, 307);
$pdf->Write(5, $tramite["DetalleTramite"]["boleta_prenumerada"]);
$pdf->setXY(20, 315);
$pdf->Write(10, $DomicilioActual["Calle"] . " " . $DomicilioActual["nro_calle"] . " " . $DomicilioActual["piso"] . " " . $DomicilioActual["depto"]);
$pdf->SetFont('Arial', '', 10);
$pdf->setXY(47, 310);
$pdf->Write(10, $Ente["apellido"] . " " . $Ente["nombre"]);
$pdf->setXY(20, 318);
$pdf->Write(10, $Ente["dni"]);



$pdf->AddPage('P', 'Legal');
if (isset($Nacimiento)) {
    $pdf->setXY(95, 69);
    $pdf->Write(10, $Nacimiento["incripto_en"]);
    $pdf->setXY(187, 69);
    $pdf->Write(10, $Nacimiento["nro_oficina"]);
    $pdf->setXY(37, 74);
    $pdf->Write(10, $Nacimiento["id_provincia"]);
    $pdf->setXY(117, 74);
    $pdf->Write(10, $Nacimiento["acta_nro"]);
    $pdf->setXY(148, 74);
    $pdf->Write(10, $Nacimiento["tomo_nro"]);
    $pdf->setXY(170, 74);
    $pdf->Write(10, $Nacimiento["folio_nro"]);
    $pdf->setXY(195, 74);
    $pdf->Write(10, $Nacimiento["anio"]);
    $pdf->setXY(35, 80);
    $pdf->Write(10, $Nacimiento["observaciones"]);
    $pdf->setXY(37, 92);
    $pdf->Write(10, $Nacimiento["apellido_padre"]);
    $pdf->setXY(37, 98);
    $pdf->Write(10, $Nacimiento["nombre_padre"]);
    $pdf->setXY(174, 98);
    $pdf->Write(10, $Nacimiento["dni_padre"]);
    $pdf->setXY(37, 104);
    $pdf->Write(10, $Nacimiento["apellido_madre"]);
    $pdf->setXY(37, 110);
    $pdf->Write(10, $Nacimiento["nombre_madre"]);
    $pdf->setXY(171, 110);
    $pdf->Write(10, $Nacimiento["dni_madre"]);
}
if (in_array("cambioDomicilio", $_SESSION["datosTramite"]["tramites"])) {
    $pdf->setXY(41, 127);
    $pdf->Write(10, 'X');
}
/*
  if (in_array("reposicion",$_SESSION["datosTramite"]["tramites"]))
  {
  $pdf->setXY(41,132);
  $pdf->Write(10,'X');
  }
 */
if (in_array("reposicion", $_SESSION["datosTramite"]["tramites"])) {
    $pdf->setXY(120, 128);
    $pdf->Write(9, 'X');
    $pdf->setXY(8, 139);
    $pdf->Write(10, 'Reposición');
}

if (in_array("rectificacion", $_SESSION["datosTramite"]["tramites"])) {
    $pdf->setXY(120, 133);
    $pdf->Write(9, 'X');
}

if (in_array("nuevoEjemplar", $_SESSION["datosTramite"]["tramites"])) {
    $pdf->setXY(198, 123);
    $pdf->Write(10, 'X');
    $pdf->setXY(92, 139);
    $pdf->Write(10, 'Nuevo Ejemplar');
}

if (in_array("actualizacionMenor", $_SESSION["datosTramite"]["tramites"])) {
    $pdf->setXY(198, 128);
    $pdf->Write(10, 'X');
}

if (in_array("actualizacionMayor16", $_SESSION["datosTramite"]["tramites"])) {
    $pdf->setXY(198, 134);
    $pdf->Write(10, 'X');
}

if (in_array("dniCeroAnio", $_SESSION["datosTramite"]["tramites"])) {
    $pdf->setXY(198, 139);
    $pdf->Write(10, 'X');
}
if($domicilioAnterior->exists())
{
    $pdf->setXY(37, 159);
    $pdf->Write(10, $DomicilioAnterior["Provincia"]);
    $pdf->setXY(32, 165);
    $pdf->Write(10, $DomicilioAnterior["PartidoDepto"]);
    $pdf->setXY(131, 165);
    $pdf->Write(10, $DomicilioAnterior["Localidad"]);
    $pdf->setXY(55, 170);
    $pdf->Write(10, $DomicilioAnterior["barrio"]);
    $pdf->setXY(20, 176);
    $pdf->Write(10, $DomicilioAnterior["Calle"]);
    $pdf->setXY(192, 176);
    $pdf->Write(10, $DomicilioAnterior["nro_calle"]);
    $pdf->setXY(20, 182);
    $pdf->Write(10, $DomicilioAnterior["piso"]);
    $pdf->setXY(42, 182);
    $pdf->Write(10, $DomicilioAnterior["depto"]);
    $pdf->setXY(72, 182);
    $pdf->Write(10, $DomicilioAnterior["cod_postal"]);
}

if (isset($Reposicion)) {
    $repo_izq = $Reposicion["dice"];

    if (strlen($repo_izq) > 50) {
        $texto2 = substr($repo_izq, 0, 50);
        $texto3 = substr($repo_izq, 50, 100);
        $pdf->setXY(17, 204);
        $pdf->Write(10, $texto2);
        $pdf->setXY(17, 208);
        $pdf->Write(10, $texto3);
    } else {
        $pdf->setXY(17, 204);
        $pdf->Write(10, $repo_izq);
    }
    $repo_der = $Reposicion["debe_decir"];

    if (strlen($repo_der) > 45) {
        $texto2 = substr($repo_der, 0, 45);
        $texto3 = substr($repo_der, 45, 90);
        $pdf->setXY(118, 204);
        ;
        $pdf->Write(10, $texto2);
        $pdf->setXY(118, 208);
        $pdf->Write(10, $texto3);
    } else {
        $pdf->setXY(118, 204);
        $pdf->Write(10, $repo_der);
    }
}

if (isset($Rectificacion)) {
    $recti_izq = $Rectificacion["dice"];

    if (strlen($recti_izq) > 50) {
        $texto2 = substr($recti_izq, 0, 50);
        $texto3 = substr($recti_izq, 50, 100);
        $pdf->setXY(17, 238);
        $pdf->Write(10, $texto2);
        $pdf->setXY(17, 242);
        $pdf->Write(10, $texto3);
    } else {
        $pdf->setXY(17, 238);
        $pdf->Write(10, $recti_izq);
    }
    $recti_der = $Rectificacion["debe_decir"];

    if (strlen($recti_der) > 45) {
        $texto2 = substr($recti_der, 0, 45);
        $texto3 = substr($recti_der, 45, 90);
        $pdf->setXY(118, 238);
        $pdf->Write(10, $texto2);
        $pdf->setXY(118, 242);
        $pdf->Write(10, $texto3);
    } else {
        $pdf->setXY(118, 238);
        $pdf->Write(10, $recti_der);
    }


    $pdf->setXY(80, 250);
    $pdf->Write(10, $Rectificacion["cartilla"]);
}
$pdf->Output();
?>

