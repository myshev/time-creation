<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('ProductSubcategory', 'doctrine');

/**
 * BaseProductSubcategory
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $name
 * @property integer $product_category_id
 * @property string $announce
 * @property clob $description
 * @property string $image
 * @property boolean $is_active
 * @property ProductCategory $Certificate
 * 
 * @method string             getName()                Returns the current record's "name" value
 * @method integer            getProductCategoryId()   Returns the current record's "product_category_id" value
 * @method string             getAnnounce()            Returns the current record's "announce" value
 * @method clob               getDescription()         Returns the current record's "description" value
 * @method string             getImage()               Returns the current record's "image" value
 * @method boolean            getIsActive()            Returns the current record's "is_active" value
 * @method ProductCategory    getCertificate()         Returns the current record's "Certificate" value
 * @method ProductSubcategory setName()                Sets the current record's "name" value
 * @method ProductSubcategory setProductCategoryId()   Sets the current record's "product_category_id" value
 * @method ProductSubcategory setAnnounce()            Sets the current record's "announce" value
 * @method ProductSubcategory setDescription()         Sets the current record's "description" value
 * @method ProductSubcategory setImage()               Sets the current record's "image" value
 * @method ProductSubcategory setIsActive()            Sets the current record's "is_active" value
 * @method ProductSubcategory setCertificate()         Sets the current record's "Certificate" value
 * 
 * @package    manymoney
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseProductSubcategory extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('product_subcategory');
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'comment' => 'Название подкатегории',
             'length' => 255,
             ));
        $this->hasColumn('product_category_id', 'integer', null, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'comment' => 'ID категории',
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
        $this->hasOne('ProductCategory as Certificate', array(
             'local' => 'product_category_id',
             'foreign' => 'id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $sortable0 = new Doctrine_Template_Sortable();
        $this->actAs($timestampable0);
        $this->actAs($sortable0);
    }
}