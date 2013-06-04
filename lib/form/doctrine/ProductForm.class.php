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

		$this->widgetSchema['image'] = new sfWidgetFormInputFileEditable(array(
			'label'     => 'Image',
			'file_src'  => '/uploads/product/thumb/'.$this->getObject()->getImage(),
			'is_image'  => true,
			'edit_mode' => !$this->isNew(),
			'template'  => '<div>'.($this->getObject()->getImage() ? '%file%' : '') .'<br />%input%<br />%delete% %delete_label%</div>',
		));
		$iMb		= 5;

		$this->validatorSchema['image'] = new sfValidatorFileThumb (
			array(
				'path'        => sfConfig::get('sf_upload_dir') . DIRECTORY_SEPARATOR . 'product',
				'required'    => false,
				'mime_types'  => 'web_images',
				// Part below concerning a thumbnail
				'with_thumb'  => true,
				'thumb_path'  => sfConfig::get('sf_upload_dir') . DIRECTORY_SEPARATOR . 'product/thumb',
				'thumb_scale' => true,
				'thumb_inflate' => true,
				'thumb_quality' => 80, // must be in a range [0-100]
//				'thumb_dimensions'  => array('width' => 170, 'height' => 154)
				'thumb_dimensions'  => array('width' => 150),

				'with_resize_full'		=> true,
				'full_dimensions'	=> array('width'	=> 370),
				'max_size'		=> $iMb * 1024 *1024
			),
			array(
				'mime_types' => 'Формат загружаемого файла не соответствует разрешенному (jpg, gif, png)',
				'max_size' => 'Размер изображения не должен превышать '.$iMb.' Мб'
			)
		);

		$this->validatorSchema['image_delete'] = new sfValidatorPass();

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

	/*	$this->setWidget('product_subcategory_list', new sfWidgetFormDoctrineChoiceGrouped(array(
			'model' => 'ProductSubcategory',
			'multiple' => true,
			'group_by' => 'ProductCategory',
			'renderer_class' => 'sfWidgetFormSelectDoubleList',
		)));

		$this->validatorSchema['product_subcategory_list'] = new sfValidatorDoctrineChoice(array(
			'model' => 'ProductSubcategory',
			'required' => false,
			'multiple' => true,
		));*/

		$this->widgetSchema['link_product_2_product'] = new sfWidgetFormChoice (array(
			'choices'			=> ProductTable::getInstance()->getProductsForProductLink($this->getObject()->getId()),
			'multiple'			=> true,
			'renderer_class'	=> 'sfWidgetFormSelectDoubleList',
			'renderer_options'	=> array(
				'label_associated'		=> 'Связанные',
				'label_unassociated'	=> 'Доступные',
				'associated_first'		=> false
			)
		));
		$this->validatorSchema['link_product_2_product'] = new sfValidatorPass();
		$this->getWidget('link_product_2_product')->setDefault(Product2ProductTable::getInstance()->getLinkedProducts($this->getObject()->getId()));

		$this->removeFields();
	}

	private function removeFields() {
		unset(
			$this['created_at'],
			$this['updated_at']
		);
	}

	/**
	 * Removes the current file for the field.
	 * Теперь еще и удаляем thumb
	 *
	 * @param string $field The field name
	 */
	protected function removeFile($field)
	{
		parent::removeFile($field);
		if (!$this->validatorSchema[$field] instanceof sfValidatorFile)	{
			throw new LogicException(sprintf('You cannot remove the current file for field "%s" as the field is not a file.', $field));
		}

		$directory = $this->validatorSchema[$field]->getOption('path');
		if ($directory && is_file($file = $directory.'/'.$this->getObject()->$field)) {
			unlink($file);
		}

		/*
		 * та самая дороботка!
		 * переопределяем метод removeFile для того чтоб добавить автоматическое удаление thumb
		 * */
		$directory_thumb = $this->validatorSchema[$field]->getOption('thumb_path');
		if ($directory_thumb && is_file($fileThumb = $directory_thumb .'/'. $this->getObject()->$field))	{
			unlink($fileThumb);
		}
	}

	/*public function updateObject($values = null) {
		parent::updateObject($values = null);
	}*/

	public function doSave($con = null) {
		parent::doSave($con);

		if(isset($this['link_product_2_product'])) {
			$iCurrentAcId = $this->getObject()->getId();
			$aSelectedAc = $this->values['link_product_2_product'];
			$iCntSelectedAc = count($aSelectedAc);

			/* существующие связки продуктов с текущим продуктом */
			$oCurrentAcLinks = Product2ProductTable::getInstance()->getLinkedProductsRecords($iCurrentAcId);
			$iCntCurrentAcLinks = $oCurrentAcLinks->count();

			/* если выбраных продуктов больше или равно чем сохраненных в базе,
			то обновляем существующие и, если надо, добавляем недостающие */
			$i = 0;
			if($iCntSelectedAc >= $iCntCurrentAcLinks) {
				if($iCntCurrentAcLinks > 0) {
					foreach($oCurrentAcLinks as $oAcLink) {
						/* обновляем существующие записи */
						$this->updateProduct($oAcLink, $iCurrentAcId, $aSelectedAc[$i]);
						$i++;
					}
				}

				if($iCntSelectedAc > $iCntCurrentAcLinks) {
					for($j = $i; $j < $iCntSelectedAc; $j++) {
						$this->updateProduct(new Product2Product(), $iCurrentAcId, $aSelectedAc[$i]);
						$i++;
					}
				}
			} else {
				/* если выбраных продуктов меньше чем в базе, обновляем существующие, и удаляем не нужные */
				foreach($oCurrentAcLinks as $oAcLink) {
					if($iCntSelectedAc > $i) {
						/* обновляем существующие записи, если есть что обновлять*/
						$this->updateProduct($oAcLink, $iCurrentAcId, $aSelectedAc[$i]);
					} else {
						/* Удаляем лишнее */
						$oAcLink->delete();
					}
					$i++;
				}
			}
		}
	}

	private function updateProduct($oProduct2Product, $productId, $iParentProductId) {
		if(is_object($oProduct2Product) && (intval($iParentProductId) != intval($productId))) {
			$oProduct2Product->product_id = $productId;
			$oProduct2Product->parent_product_id = $iParentProductId;
			return $oProduct2Product->save();
		}
		return false;
	}
}
