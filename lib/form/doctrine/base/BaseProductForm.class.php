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
      'id'                       => new sfWidgetFormInputHidden(),
      'name'                     => new sfWidgetFormInputText(),
      'announce'                 => new sfWidgetFormTextarea(),
      'description'              => new sfWidgetFormTextarea(),
      'image'                    => new sfWidgetFormInputText(),
      'is_active'                => new sfWidgetFormInputCheckbox(),
      'created_at'               => new sfWidgetFormDateTime(),
      'updated_at'               => new sfWidgetFormDateTime(),
      'product_subcategory_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'ProductSubcategory')),
    ));

    $this->setValidators(array(
      'id'                       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'                     => new sfValidatorString(array('max_length' => 255)),
      'announce'                 => new sfValidatorString(array('max_length' => 1000)),
      'description'              => new sfValidatorString(),
      'image'                    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'is_active'                => new sfValidatorBoolean(array('required' => false)),
      'created_at'               => new sfValidatorDateTime(),
      'updated_at'               => new sfValidatorDateTime(),
      'product_subcategory_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'ProductSubcategory', 'required' => false)),
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

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['product_subcategory_list']))
    {
      $this->setDefault('product_subcategory_list', $this->object->ProductSubcategory->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveProductSubcategoryList($con);

    parent::doSave($con);
  }

  public function saveProductSubcategoryList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['product_subcategory_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->ProductSubcategory->getPrimaryKeys();
    $values = $this->getValue('product_subcategory_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('ProductSubcategory', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('ProductSubcategory', array_values($link));
    }
  }

}
