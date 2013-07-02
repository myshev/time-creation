<?php

/**
 * Product filter form base class.
 *
 * @package    manymoney
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseProductFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'announce'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'image'                  => new sfWidgetFormFilterInput(),
      'is_active'              => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'quantity_in_stock'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cost'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'manufacturer_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Manufacturer'), 'add_empty' => true)),
      'alias'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'product_subcategory_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProductSubcategory'), 'add_empty' => true)),
      'created_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'name'                   => new sfValidatorPass(array('required' => false)),
      'announce'               => new sfValidatorPass(array('required' => false)),
      'description'            => new sfValidatorPass(array('required' => false)),
      'image'                  => new sfValidatorPass(array('required' => false)),
      'is_active'              => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'quantity_in_stock'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cost'                   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'manufacturer_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Manufacturer'), 'column' => 'id')),
      'alias'                  => new sfValidatorPass(array('required' => false)),
      'product_subcategory_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ProductSubcategory'), 'column' => 'id')),
      'created_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('product_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Product';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'name'                   => 'Text',
      'announce'               => 'Text',
      'description'            => 'Text',
      'image'                  => 'Text',
      'is_active'              => 'Boolean',
      'quantity_in_stock'      => 'Number',
      'cost'                   => 'Number',
      'manufacturer_id'        => 'ForeignKey',
      'alias'                  => 'Text',
      'product_subcategory_id' => 'ForeignKey',
      'created_at'             => 'Date',
      'updated_at'             => 'Date',
    );
  }
}
