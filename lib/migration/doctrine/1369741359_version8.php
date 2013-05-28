<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version8 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createTable('product', array(
             'id' => 
             array(
              'type' => 'integer',
              'length' => '8',
              'autoincrement' => '1',
              'primary' => '1',
             ),
             'name' => 
             array(
              'type' => 'string',
              'fixed' => '0',
              'unsigned' => '',
              'primary' => '',
              'notnull' => '1',
              'autoincrement' => '',
              'comment' => 'Название продукта',
              'length' => '255',
             ),
             'announce' => 
             array(
              'type' => 'string',
              'notnull' => '1',
              'comment' => 'Анонс',
              'length' => '1000',
             ),
             'description' => 
             array(
              'type' => 'clob',
              'notnull' => '1',
              'comment' => 'Описание',
              'length' => '',
             ),
             'image' => 
             array(
              'type' => 'string',
              'fixed' => '0',
              'unsigned' => '',
              'primary' => '',
              'notnull' => '',
              'autoincrement' => '',
              'comment' => 'Изображение',
              'length' => '255',
             ),
             'is_active' => 
             array(
              'type' => 'boolean',
              'notnull' => '1',
              'default' => '1',
              'comment' => 'Элемент активен',
              'length' => '25',
             ),
             'created_at' => 
             array(
              'notnull' => '1',
              'type' => 'timestamp',
              'length' => '25',
             ),
             'updated_at' => 
             array(
              'notnull' => '1',
              'type' => 'timestamp',
              'length' => '25',
             ),
             ), array(
             'primary' => 
             array(
              0 => 'id',
             ),
             ));
    }

    public function down()
    {
        $this->dropTable('product');
    }
}