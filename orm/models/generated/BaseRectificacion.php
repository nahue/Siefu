<?php

/**
 * BaseRectificacion
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $dice
 * @property string $debe_decir
 * @property string $cartilla
 * @property integer $DetalleTramite_id
 * @property DetalleTramite $DetalleTramite
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseRectificacion extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('siefu.rectificacion');
        $this->hasColumn('id', 'integer', null, array(
             'primary' => true,
             'type' => 'integer',
             'autoincrement' => true,
             ));
        $this->hasColumn('dice', 'string', 150, array(
             'type' => 'string',
             'length' => '150',
             ));
        $this->hasColumn('debe_decir', 'string', 150, array(
             'type' => 'string',
             'length' => '150',
             ));
        $this->hasColumn('cartilla', 'string', 2, array(
             'type' => 'string',
             'length' => '2',
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