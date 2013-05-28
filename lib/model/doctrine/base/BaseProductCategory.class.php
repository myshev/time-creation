<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('ProductCategory', 'doctrine');

/**
 * BaseProductCategory
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $name
 * @property string $announce
 * @property clob $description
 * @property string $image
 * @property boolean $is_active
 * @property Doctrine_Collection $ProductSubcategory
 * 
 * @method string              getName()               Returns the current record's "name" value
 * @method string              getAnnounce()           Returns the current record's "announce" value
 * @method clob                getDescription()        Returns the current record's "description" value
 * @method string              getImage()              Returns the current record's "image" value
 * @method boolean             getIsActive()           Returns the current record's "is_active" value
 * @method Doctrine_Collection getProductSubcategory() Returns the current record's "ProductSubcategory" collection
 * @method ProductCategory     setName()               Sets the current record's "name" value
 * @method ProductCategory     setAnnounce()           Sets the current record's "announce" value
 * @method ProductCategory     setDescription()        Sets the current record's "description" value
 * @method ProductCategory     setImage()              Sets the current record's "image" value
 * @method ProductCategory     setIsActive()           Sets the current record's "is_active" value
 * @method ProductCategory     setProductSubcategory() Sets the current record's "ProductSubcategory" collection
 * 
 * @package    manymoney
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseProductCategory extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('product_category');
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'comment' => 'Название категории',
             'length' => 255,
             ));
        $this->hasColumn('announce', 'string', 1000, array(
             'type' => 'string',
             'notnull' => true,
             'comment' => 'Анонс',
             'length' => 1000,
             ));
        $this->hasColumn('description', 'clob', null, array(
             'type' => 'clob',
             'notnull' => true,
             'comment' => 'Описание',
             ));
        $this->hasColumn('image', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'comment' => 'Изображение',
             'length' => 255,
             ));
        $this->hasColumn('is_active', 'boolean', null, array(
             'type' => 'boolean',
             'notnull' => true,
             'default' => true,
             'comment' => 'Элемент активен',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('ProductSubcategory', array(
             'local' => 'id',
             'foreign' => 'product_category_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $sortable0 = new Doctrine_Template_Sortable();
        $this->actAs($timestampable0);
        $this->actAs($sortable0);
    }
}