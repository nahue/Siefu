<?php
ob_start();
session_start();
require("../config.inc.php");
require_once('../DoctrineBootstrap.php');
require('../clases/Bd.class.php');
//fb::log($_POST);
ini_set("display_errors",1);
date_default_timezone_set("America/Argentina/Ushuaia");
$_SESSION["datosTramite"]["boleta"] = $_POST["boleta_prenumerada"];

try {

    /*
     * DOMICILIO
     * ANTERIOR
     */
    if (
            isset($_POST["barrio_anterior"]) &&
            isset($_POST["nro_calle_anterior"]) &&
            isset($_POST["piso_anterior"]) &&
            isset($_POST["depto_anterior"]) &&
            isset($_POST["cod_postal_anterior"]) &&
            isset($_POST["telefono_anterior"])) {

        $provinciaAnterior = new Provincia();
        $provinciaAnterior = strtoupper($provinciaAnterior->Descripcion($_POST["provincia_anterior"]));
        $provinciaAnterior->save();


        $localidadAnterior = new Localidad();
        $localidadAnterior = strtoupper($localidadAnterior->Descripcion($_POST["localidad_anterior"]));
        $localidadAnterior->save();

        $calleAnterior = new Calle();
        $calleAnterior = strtoupper($calleAnterior->Descripcion($_POST["calle_anterior"]));
        $calleAnterior->save();

        $partidodeptoAnterior = new PartidoDepto();
        $partidodeptoAnterior = strtoupper($partidodeptoAnterior->Descripcion($_POST["partido_depto_anterior"]));
        $partidodeptoAnterior->save();


        $domicilioAnterior = new Domicilio();
        $domicilioAnterior->barrio = strtoupper($_POST["barrio_anterior"]);
        $domicilioAnterior->nro_calle = $_POST["nro_calle_anterior"];
        $domicilioAnterior->piso = strtoupper($_POST["piso_anterior"]);
        $domicilioAnterior->depto = strtoupper($_POST["depto_anterior"]);
        $domicilioAnterior->cod_postal = $_POST["cod_postal_anterior"];
        $domicilioAnterior->telefono = $_POST["telefono_anterior"];

        if (isset($provinciaAnterior))
            $domicilioAnterior->Provincia = $provinciaAnterior;

        if (isset($localidadAnterior))
            $domicilioAnterior->Localidad = $localidadAnterior;

        if (isset($calleAnterior))
            $domicilioAnterior->Calle = $calleAnterior;

        if (isset($partidodeptoAnterior))
            $domicilioAnterior->PartidoDepto = $partidodeptoAnterior;

        $domicilioAnterior->save();
    } else {
        $domicilioAnterior = false;
    }
    /*
     * DOMICILIO
     * ACTUAL
     */
     if (
            isset($_POST["barrio"]) &&
            isset($_POST["nro_calle"]) &&
            isset($_POST["piso"]) &&
            isset($_POST["depto"]) &&
            isset($_POST["cod_postal"]) &&
            isset($_POST["telefono"])) {
    $provinciaActual = new Provincia();
    $provinciaActual = $provinciaActual->Descripcion(strtoupper($_POST["provincia"]));
    $provinciaActual->save();

    $localidadActual = new Localidad();
    $localidadActual = $localidadActual->Descripcion(strtoupper($_POST["localidad"]));
    $localidadActual->save();

    $calleActual = new Calle();
    $calleActual = $calleActual->Descripcion(strtoupper($_POST["calle"]));
    $calleActual->save();

    $partidodeptoActual = new PartidoDepto();
    $partidodeptoActual = $partidodeptoActual->Descripcion(strtoupper($_POST["partido_depto"]));
    $partidodeptoActual->save();

    $domicilioActual = new Domicilio();
    $domicilioActual->barrio = strtoupper($_POST["barrio"]);
    $domicilioActual->nro_calle = strtoupper($_POST["nro_calle"]);
    $domicilioActual->piso = strtoupper($_POST["piso"]);
    $domicilioActual->depto = strtoupper($_POST["depto"]);
    $domicilioActual->cod_postal = strtoupper($_POST["cod_postal"]);
    $domicilioActual->telefono = strtoupper($_POST["telefono"]);

    $domicilioActual->Provincia = $provinciaActual;
    $domicilioActual->Localidad = $localidadActual;
    $domicilioActual->Calle = $calleActual;
    $domicilioActual->PartidoDepto = $partidodeptoActual;
    $domicilioActual->save();
            } else {
                $domicilioActual = false;
            }
    $provinciaNacimiento = new Provincia();
    $provinciaNacimiento = $provinciaNacimiento->Descripcion(strtoupper($_POST["provincia_nacimiento"]));
    $provinciaNacimiento->save();

    $localidadNacimiento = new Localidad();
    $localidadNacimiento = $localidadNacimiento->Descripcion(strtoupper($_POST["localidad_nacimiento"]));
    $localidadNacimiento->save();

    $partidodeptoNacimiento = new PartidoDepto();
    $partidodeptoNacimiento = $partidodeptoNacimiento->Descripcion(strtoupper($_POST["partido_nacimiento"]));
    $partidodeptoNacimiento->save();
    
    $ente = new Ente();
    $ente = $ente->crear($_POST["dni"]);
    $ente->dni2 = $_POST["dni2"];
    $ente->apellido = strtoupper($_POST["apellido"]);
    $ente->nombre = strtoupper($_POST["nombre"]);
    $ente->sexo_id = $_POST["sexo_id"];
    $ente->fecha_nacimiento = Bd::FechaAMysql(trim($_POST["fecha_nacimiento"]));
    $ente->pais_id = $_POST["pais_id"];
    $ente->veterano = $_POST["veterano"];
    if ($_POST["pais_id"] == "12")
        $ente->extranjero = 0;
    else
        $ente->extranjero = 1;
    
    $ente->id_estado_civil = $_POST["id_estado_civil"];
    if ($domicilioAnterior != false)
        $ente->Domicilios->add($domicilioAnterior);
    if ($domicilioActual != false)
        $ente->Domicilios->add($domicilioActual);
    $ente->provincia_nacimiento = $provinciaNacimiento;
    $ente->localidad_nacimiento = $localidadNacimiento;
    $ente->partido_nacimiento = $partidodeptoNacimiento;
    $ente->save();

    /* DATOS DEL TRAMITE */

    $tramite = new Tramite();
    $tramite->descripcion = "Prueba de Tramite";
    $tramite->save();

    $detalleTramite = new DetalleTramite();
    $detalleTramite = $detalleTramite->crear($_POST["boleta_prenumerada"]);
    $detalleTramite->Tramite = $tramite;
    $detalleTramite->Usuario_id = $_SESSION["usuario"]["id"];
    $detalleTramite->save();


    $datoTramite = new DatoTramite();
    $datoTramite->fecha = Bd::FechaAMysql(trim($_POST["fecha_tramite"]));
    $datoTramite->id_oficina_seccional = $_POST["id_oficina_seccional"];
    $datoTramite->oficina_seccion = $_POST["oficina_seccion"];
    $datoTramite->Ente = $ente;
    $datoTramite->DetalleTramite = $detalleTramite;
    $datoTramite->save();

    $carrera = new Carrera();
    $carrera = $carrera->Descripcion(strtoupper($_POST["carrera"]));
    $carrera->save();

    $educacional = new Educacional();
    $educacional = $educacional->ente_id($ente->id);
    $educacional->Carrera = $carrera;
    $educacional->mas_nivel_educacional = strtoupper($_POST["mas_nivel_educacional"]);
    $educacional->profesion = strtoupper($_POST["profesion"]);
    $educacional->titulo_posgrado = strtoupper($_POST["titulo_posgrado"]);
    $educacional->ocupacion = strtoupper($_POST["ocupacion"]);
    $educacional->cambios = strtoupper($_POST["cambios"]);
    $educacional->lee_escribe = strtoupper($_POST["lee_escribe"]);
    $educacional->save();


    echo json_encode(array("respuesta" => "true"));

} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}
?>
