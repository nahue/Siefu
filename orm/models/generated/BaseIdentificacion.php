<?php

/**
 * BaseIdentificacion
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $documento
 * @property string $nacionalidad
 * @property string $nacionalidad_acquirida
 * @property string $pasaporte
 * @property date $fecha_ingreso_pais
 * @property char $cat_radicacion
 * @property date $fecha_radicacion
 * @property string $expediente_nro
 * @property string $res_dis_dtop
 * @property date $fecha_vencimiento_temporaria
 * @property date $prorroga
 * @property string $apellido_nombre_padre
 * @property string $apellido_nombre_madre
 * @property integer $DetalleTramite_id
 * @property DetalleTramite $DetalleTramite
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseIdentificacion extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('siefu.identificacion');
        $this->hasColumn('id', 'integer', null, array(
             'primary' => true,
             'type' => 'integer',
             'autoincrement' => true,
             ));
        $this->hasColumn('documento', 'string', 45, array(
             'type' => 'string',
             'length' => '45',
             ));
        $this->hasColumn('nacionalidad', 'string', 45, array(
             'type' => 'string',
             'length' => '45',
             ));
        $this->hasColumn('nacionalidad_acquirida', 'string', 45, array(
             'type' => 'string',
             'length' => '45',
             ));
        $this->hasColumn('pasaporte', 'string', 45, array(
             'type' => 'string',
             'length' => '45',
             ));
        $this->hasColumn('fecha_ingreso_pais', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('cat_radicacion', 'char', 1, array(
             'type' => 'char',
             'length' => '1',
             ));
        $this->hasColumn('fecha_radicacion', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('expediente_nro', 'string', 45, array(
             'type' => 'string',
             'length' => '45',
             ));
        $this->hasColumn('res_dis_dtop', 'string', 45, array(
             'type' => 'string',
             'length' => '45',
             ));
        $this->hasColumn('fecha_vencimiento_temporaria', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('prorroga', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('apellido_nombre_padre', 'string', 45, array(
             'type' => 'string',
             'length' => '45',
             ));
        $this->hasColumn('apellido_nombre_madre', 'string', 45, array(
             'type' => 'string',
             'length' => '45',
             ));
        $this->hasColumn('DetalleTramite_id', 'integer', null, array(
             'unique' => true,
             'type' => 'integer',
             ));

        $this->option('charset', 'latin1');
        $this->option('type', 'InnoDB');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('DetalleTramite', array(
             'local' => 'DetalleTramite_id',
             'foreign' => 'id'));
    }
}