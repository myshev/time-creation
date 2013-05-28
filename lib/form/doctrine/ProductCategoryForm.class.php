<?php

/**
 * ProductCategory form.
 *
 * @package    manymoney
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProductCategoryForm extends BaseProductCategoryForm
{
	public function configure() {
		parent::configure();

		$this->removeFields();
	}

	private function removeFields() {
		unset(
			$this['created_at'],
			$this['updated_at'],
			$this['position']
		);
	}
}
