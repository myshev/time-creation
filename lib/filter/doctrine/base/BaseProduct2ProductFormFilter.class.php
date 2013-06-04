<?php

/**
 * Product2Product filter form base class.
 *
 * @package    manymoney
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseProduct2ProductFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'product_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Product'), 'add_empty' => true)),
      'parent_product_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ParentProduct'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'product_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Product'), 'column' => 'id')),
      'parent_product_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ParentProduct'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('product2_product_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Product2Product';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'product_id'        => 'ForeignKey',
      'parent_product_id' => 'ForeignKey',
    );
  }
}
