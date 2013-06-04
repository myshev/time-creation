<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version13 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createForeignKey('product2product', 'product2product_product_id_product_id', array(
             'name' => 'product2product_product_id_product_id',
             'local' => 'product_id',
             'foreign' => 'id',
             'foreignTable' => 'product',
             'onUpdate' => '',
             'onDelete' => 'CASCADE',
             ));
        $this->createForeignKey('product2product', 'product2product_parent_product_id_product_id', array(
             'name' => 'product2product_parent_product_id_product_id',
             'local' => 'parent_product_id',
             'foreign' => 'id',
             'foreignTable' => 'product',
             'onUpdate' => '',
             'onDelete' => 'CASCADE',
             ));
        $this->addIndex('product2product', 'product2product_product_id', array(
             'fields' => 
             array(
              0 => 'product_id',
             ),
             ));
        $this->addIndex('product2product', 'product2product_parent_product_id', array(
             'fields' => 
             array(
              0 => 'parent_product_id',
             ),
             ));
    }

    public function down()
    {
        $this->dropForeignKey('product2product', 'product2product_product_id_product_id');
        $this->dropForeignKey('product2product', 'product2product_parent_product_id_product_id');
        $this->removeIndex('product2product', 'product2product_product_id', array(
             'fields' => 
             array(
              0 => 'product_id',
             ),
             ));
        $this->removeIndex('product2product', 'product2product_parent_product_id', array(
             'fields' => 
             array(
              0 => 'parent_product_id',
             ),
             ));
    }
}