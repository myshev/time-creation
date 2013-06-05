<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version14 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->addColumn('product_category', 'alias', 'string', '255', array(
             'fixed' => '0',
             'unsigned' => '',
             'primary' => '',
             'notnull' => '1',
             'autoincrement' => '',
             'comment' => 'Алиас',
             ));
        $this->addColumn('product_subcategory', 'alias', 'string', '255', array(
             'fixed' => '0',
             'unsigned' => '',
             'primary' => '',
             'notnull' => '1',
             'autoincrement' => '',
             'comment' => 'Алиас',
             ));
    }

    public function down()
    {
        $this->removeColumn('product_category', 'alias');
        $this->removeColumn('product_subcategory', 'alias');
    }
}