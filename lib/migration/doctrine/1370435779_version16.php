<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version16 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->addColumn('product', 'alias', 'string', '255', array(
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
        $this->removeColumn('product', 'alias');
    }
}