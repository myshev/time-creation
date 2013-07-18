<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version20 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createForeignKey('product', 'product_product_subcategory_id_product_subcategory_id', array(
             'name' => 'product_product_subcategory_id_product_subcategory_id',
             'local' => 'product_subcategory_id',
             'foreign' => 'id',
             'foreignTable' => 'product_subcategory',
             'onUpdate' => '',
             'onDelete' => 'CASCADE',
             ));
        $this->addIndex('product', 'product_product_subcategory_id', array(
             'fields' => 
             array(
              0 => 'product_subcategory_id',
             ),
             ));
    }

    public function down()
    {
        $this->dropForeignKey('product', 'product_product_subcategory_id_product_subcategory_id');
        $this->removeIndex('product', 'product_product_subcategory_id', array(
             'fields' => 
             array(
              0 => 'product_subcategory_id',
             ),
             ));
    }
}