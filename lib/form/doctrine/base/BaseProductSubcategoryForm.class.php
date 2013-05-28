<?php

/**
 * ProductSubcategory form base class.
 *
 * @method ProductSubcategory getObject() Returns the current form's model object
 *
 * @package    manymoney
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProductSubcategoryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'name'                => new sfWidgetFormInputText(),
      'product_category_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Certificate'), 'add_empty' => true)),
      'announce'            => new sfWidgetFormTextarea(),
      'description'         => new sfWidgetFormTextarea(),
      'image'               => new sfWidgetFormInputText(),
      'is_active'           => new sfWidgetFormInputCheckbox(),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
      'position'            => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'                => new sfValidatorString(array('max_length' => 255)),
      'product_category_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Certificate'), 'required' => false)),
      'announce'            => new sfValidatorString(array('max_length' => 1000)),
      'description'         => new sfValidatorString(),
      'image'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'is_active'           => new sfValidatorBoolean(array('required' => false)),
      'created_at'          => new sfValidatorDateTime(),
      'updated_at'          => new sfValidatorDateTime(),
      'position'            => new sfValidatorInteger(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'ProductSubcategory', 'column' => array('position')))
    );

    $this->widgetSchema->setNameFormat('product_subcategory[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProductSubcategory';
  }

}
