<?php

/**
 * Product form.
 *
 * @package    manymoney
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProductForm extends BaseProductForm
{
	public function configure() {
		parent::configure();

		$this->widgetSchema['product_subcategory_list'] = new sfWidgetFormChoice (array(
			'choices'			=> ProductSubcategoryTable::getInstance()->retrieveProductSubcategoryList(),
			'multiple'			=> true,
			'renderer_class'	=> 'sfWidgetFormSelectDoubleList',
			'renderer_options'	=> array(
				'label_associated'		=> 'Выбранные',
				'label_unassociated'	=> 'Доступные',
				'associated_first'		=> false
			)
		));
		$this->validatorSchema['product_subcategory_list'] = new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'ProductSubcategory', 'required' => true));


		$this->removeFields();
	}

	private function removeFields() {
		unset(
			$this['created_at'],
			$this['updated_at']
		);
	}
}
