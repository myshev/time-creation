<?php

/**
 * Product2Product form base class.
 *
 * @method Product2Product getObject() Returns the current form's model object
 *
 * @package    manymoney
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProduct2ProductForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'product_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Product'), 'add_empty' => true)),
      'parent_product_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ParentProduct'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'product_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Product'), 'required' => false)),
      'parent_product_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ParentProduct'), 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Product2Product', 'column' => array('product_id', 'parent_product_id')))
    );

    $this->widgetSchema->setNameFormat('product2_product[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Product2Product';
  }

}
