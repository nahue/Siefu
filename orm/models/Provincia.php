<?php

class Provincia extends BaseProvincia
{

    public function Descripcion($descripcion) {
        $datos = $this->getTable()->findOneBy("descripcion",$descripcion);
        if (!$datos){
            $this->descripcion = $descripcion;
            return $this;
        };
        return $datos;
    }
    
}