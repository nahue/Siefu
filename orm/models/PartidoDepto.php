<?php

/**
 * PartidoDepto
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class PartidoDepto extends BasePartidoDepto
{
    public function Descripcion($descripcion) {
        $datos = $this->getTable()->findOneBy("Descripcion",$descripcion);
        if (!$datos){
            $this->descripcion = $descripcion;
            return $this;
        };
        return $datos;
    }
}