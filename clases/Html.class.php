<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of html
 *
 * @author strato1986
 */
class Html {

    //put your code here
    public static function redireccionar($controlador = null) {
        header("Location: " . ROOT_URL . "/index.php?controlador=" . $controlador);
    }

    public static function urlModulo($controlador) {
        return ROOT_URL . "/index.php?controlador=" . $controlador;
    }

    /**
     * Enter description here ...
     * @param string $campo
     * @param string $claseCss
     * @return string
     */
    public static function labelPara($campo, $label = null, $claseCss = null) {
        $tag = "<label for=$campo><span>";
        if ($label)
            $tag .= $label;
        else
            $tag .= ucfirst($campo);
        $tag .= "</span></label>";

        return $tag;
    }

    /**
     * Enter description here ...
     * @param string $campo
     * @param string $tipo
     * @param string $valor
     * @param string $claseCss
     * @return string
     */
    public static function inputPara($campo, $tipo, $valor = null, $claseCss = null) {
        $tag = "<div class=$tipo>";

        if ($tipo != "fecha") {
            $tag .= "<input name='$campo' type='$tipo' value='$valor' class='$claseCss'/>";
        } else {
            $dia = "";
            $mes = "";
            $anio = "";
            $tag .= "<input name='dia' type='textbox' value='$dia' class='fechaDia' size='2'/> - ";
            $tag .= "<input name='mes' type='textbox' value='$mes' class='fechaMes' /> - ";
            $tag .= "<input name='anio' type='textbox' value='$anio' class='fechaAnio' /> ";
        }

        $tag .= "</div>";

        return $tag;
    }

    /**
     * Html::selectBox()
     *
     * @param string $nombre
     * @param array $datos
     * @param string $textoVacio
     * @param string $id_seleccionado
     * @return
     */
    public static function selectBox($nombre, $datos, $textoVacio = "Seleccione un dato", $id_seleccionado = null) {
        $tag = "<select name=$nombre id=$nombre required='required' type='number' data-message='Debe elegir una opcion'>";
        $tag .= "<option>$textoVacio</option>";
        foreach ($datos as $dato) {
            if ($dato["id"] == $id_seleccionado)
                $tag .= "<option value='" . $dato["id"] . "' selected='selected'>" . $dato["descripcion"] . "</option>";
            else
                $tag .= "<option value='" . $dato["id"] . "'>" . $dato["descripcion"] . "</option>";
        }
        /*
          $tag .= "<option value='0'>$textoVacio</option>";
          $tag .= "<option value='1'>Varon</option>";
          $tag .= "<option value='1'>Mujer</option>";
         */

        $tag .= "</select>";

        return $tag;
    }

    public static function obtenerUrl() {
        $s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
        $protocol = Html::_strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/") . $s;
        $port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":" . $_SERVER["SERVER_PORT"]);
        return $protocol . "://" . $_SERVER['SERVER_NAME'] . $port /* . $_SERVER['REQUEST_URI'] */;
    }

    private static function _strleft($s1, $s2) {
        return substr($s1, 0, strpos($s1, $s2));
    }

}

?>
