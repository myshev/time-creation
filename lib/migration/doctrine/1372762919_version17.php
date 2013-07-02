<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version17 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->dropForeignKey('product_subcategory2product', 'product_subcategory2product_product_id_product_id');
        $this->dropForeignKey('product_subcategory2product', 'pppi');
    }

    public function down()
    {
        $this->createForeignKey('product_subcategory2product', 'product_subcategory2product_product_id_product_id', array(
             'name' => 'product_subcategory2product_product_id_product_id',
             'local' => 'product_id',
             'foreign' => 'id',
             'foreignTable' => 'product',
             'onUpdate' => '',
             'onDelete' => 'CASCADE',
             ));
        $this->createForeignKey('product_subcategory2product', 'pppi', array(
             'name' => 'pppi',
             'local' => 'product_subcategory_id',
             'foreign' => 'id',
             'foreignTable' => 'product_subcategory',
             'onUpdate' => '',
             'onDelete' => 'CASCADE',
             ));
    }
}