<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of bd
 *
 * @author strato1986
 */
class Bd {

    var $_conexion;

    public static function conectar($args) {
        $_conexion = mysql_connect($args["host"], $args["usuario"], $args["contrasenia"]);
        mysql_select_db($args["base"]);

        return $_conexion;
    }

    public static function FechaAMysql($Fecha) {
        if ($Fecha <> "") {
            $trozos = explode("/", $Fecha, 3);
            return $trozos[2] . "-" . $trozos[1] . "-" . $trozos[0];
        } else {
            return "NULL";
        }
    }

    public static function FechaMysqlaFecha($MySQLFecha) {
        if (($MySQLFecha == "") or ($MySQLFecha == "0000-00-00")) {
            return "";
        } else {
            return date("d/m/Y", strtotime($MySQLFecha));
        }
    }

}

?>
