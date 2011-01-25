<?php

/**
 * BaseEducacional
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property boolean $lee_escribe
 * @property string $mas_nivel_educacional
 * @property string $titulo_posgrado
 * @property string $profesion
 * @property string $ocupacion
 * @property string $cambios
 * @property integer $Ente_id
 * @property integer $Carrera_id
 * @property Ente $Ente
 * @property Carrera $Carrera
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseEducacional extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('siefu.educacional');
        $this->hasColumn('id', 'integer', 4, array(
             'primary' => true,
             'type' => 'integer',
             'autoincrement' => true,
             'length' => '4',
             ));
        $this->hasColumn('lee_escribe', 'boolean', null, array(
             'type' => 'boolean',
             'notnull' => true,
             ));
        $this->hasColumn('mas_nivel_educacional', 'string', 45, array(
             'type' => 'string',
             'length' => '45',
             ));
        $this->hasColumn('titulo_posgrado', 'string', 45, array(
             'type' => 'string',
             'length' => '45',
             ));
        $this->hasColumn('profesion', 'string', 45, array(
             'type' => 'string',
             'length' => '45',
             ));
        $this->hasColumn('ocupacion', 'string', 45, array(
             'type' => 'string',
             'length' => '45',
             ));
        $this->hasColumn('cambios', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('Ente_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             ));
        $this->hasColumn('Carrera_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             ));

        $this->option('charset', 'latin1');
        $this->option('type', 'InnoDB');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Ente', array(
             'local' => 'Ente_id',
             'foreign' => 'id'));

        $this->hasOne('Carrera', array(
             'local' => 'Carrera_id',
             'foreign' => 'id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}