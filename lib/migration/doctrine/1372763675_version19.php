<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version19 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->addColumn('product', 'product_subcategory_id', 'integer', '8', array(
             'fixed' => '0',
             'unsigned' => '',
             'primary' => '',
             'notnull' => '',
             'autoincrement' => '',
             'comment' => 'ID подкатегории',
             ));
    }

    public function down()
    {
        $this->removeColumn('product', 'product_subcategory_id');
    }
}