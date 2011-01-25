<?php

/**
 * BaseLocalidad
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $descripcion
 * @property Doctrine_Collection $Domicilios
 * @property Doctrine_Collection $Entes
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLocalidad extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('localidad');
        $this->hasColumn('id', 'integer', 4, array(
             'primary' => true,
             'type' => 'integer',
             'autoincrement' => true,
             'length' => '4',
             ));
        $this->hasColumn('descripcion', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));

        $this->option('charset', 'latin1');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Domicilio as Domicilios', array(
             'local' => 'id',
             'foreign' => 'Localidad_id'));

        $this->hasMany('Ente as Entes', array(
             'local' => 'id',
             'foreign' => 'LocalidadNacimiento_id'));
    }
}