<?php

/**
 * Product form base class.
 *
 * @method Product getObject() Returns the current form's model object
 *
 * @package    manymoney
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProductForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'name'                   => new sfWidgetFormInputText(),
      'announce'               => new sfWidgetFormTextarea(),
      'description'            => new sfWidgetFormTextarea(),
      'image'                  => new sfWidgetFormInputText(),
      'is_active'              => new sfWidgetFormInputCheckbox(),
      'quantity_in_stock'      => new sfWidgetFormInputText(),
      'cost'                   => new sfWidgetFormInputText(),
      'manufacturer_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Manufacturer'), 'add_empty' => true)),
      'alias'                  => new sfWidgetFormInputText(),
      'product_subcategory_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProductSubcategory'), 'add_empty' => false)),
      'created_at'             => new sfWidgetFormDateTime(),
      'updated_at'             => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'                   => new sfValidatorString(array('max_length' => 255)),
      'announce'               => new sfValidatorString(array('max_length' => 1000)),
      'description'            => new sfValidatorString(),
      'image'                  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'is_active'              => new sfValidatorBoolean(array('required' => false)),
      'quantity_in_stock'      => new sfValidatorInteger(),
      'cost'                   => new sfValidatorInteger(),
      'manufacturer_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Manufacturer'), 'required' => false)),
      'alias'                  => new sfValidatorString(array('max_length' => 255)),
      'product_subcategory_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ProductSubcategory'))),
      'created_at'             => new sfValidatorDateTime(),
      'updated_at'             => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('product[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Product';
  }

}
