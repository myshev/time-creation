<?php

require_once dirname(__FILE__) . '/../lib/vendor/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
	public function setup()
	{

		$this->setWebDir($this->getRootDir() . '/www');

		$this->enablePlugins(array(
			'sfDoctrinePlugin',
			'csDoctrineActAsSortablePlugin',
			'sfJQueryUIPlugin',
			'sfDoctrineGuardPlugin',
			'sfCkPlugin',
			'sfFormExtraPlugin',
			'sfImageTransformPlugin',
			'sfThumbnailPlugin'
		));
	}
}