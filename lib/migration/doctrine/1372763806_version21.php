<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version21 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->changeColumn('product', 'product_subcategory_id', 'integer', '8', array(
             'fixed' => '0',
             'unsigned' => '',
             'primary' => '',
             'notnull' => '1',
             'autoincrement' => '',
             'comment' => 'ID подкатегории',
             ));
    }

    public function down()
    {

    }
}