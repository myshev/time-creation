<?php

/**
 * StatPage form.
 *
 * @package    manymoney
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class StatPageForm extends BaseStatPageForm {
	public function configure() {
		parent::configure();

		$this->widgetSchema['image'] = new sfWidgetFormInputFileEditable(array(
			'label'     => 'Image',
			'file_src'  => '/uploads/stat/thumb/'.$this->getObject()->getImage(),
			'is_image'  => true,
			'edit_mode' => !$this->isNew(),
			'template'  => '<div>'.($this->getObject()->getImage() ? '%file%' : '') .'<br />%input%<br />%delete% %delete_label%</div>',
		));
		/*$this->validatorSchema['image']	= new sfValidatorFile(
			array(
				'max_size'		=> '2000000',
				'mime_types'	=> 'web_images',
				'path'			=> sfConfig::get('sf_upload_dir') . DIRECTORY_SEPARATOR . 'stat',
				'required'    => false
			)
		);*/
		$iMb		= 5;

		$this->validatorSchema['image'] = new sfValidatorFileThumb (
			array(
				'path'        => sfConfig::get('sf_upload_dir') . DIRECTORY_SEPARATOR . 'stat',
				'required'    => false,
				'mime_types'  => 'web_images',
				// Part below concerning a thumbnail
				'with_thumb'  => true,
				'thumb_path'  => sfConfig::get('sf_upload_dir') . DIRECTORY_SEPARATOR . 'stat/thumb',
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
}
