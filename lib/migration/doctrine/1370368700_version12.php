<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version12 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createTable('product2product', array(
             'id' => 
             array(
              'type' => 'integer',
              'length' => '8',
              'autoincrement' => '1',
              'primary' => '1',
             ),
             'product_id' => 
             array(
              'type' => 'integer',
              'fixed' => '0',
              'unsigned' => '',
              'primary' => '',
              'autoincrement' => '',
              'comment' => 'Продукт 1',
              'length' => '20',
             ),
             'parent_product_id' => 
             array(
              'type' => 'integer',
              'fixed' => '0',
              'unsigned' => '',
              'primary' => '',
              'autoincrement' => '',
              'comment' => 'Продукт 2',
              'length' => '20',
             ),
             ), array(
             'indexes' => 
             array(
              'product2product_index' => 
              array(
              'fields' => 
              array(
               0 => 'product_id',
               1 => 'parent_product_id',
              ),
              'type' => 'unique',
              ),
             ),
             'primary' => 
             array(
              0 => 'id',
             ),
             ));
    }

    public function down()
    {
        $this->dropTable('product2product');
    }
}