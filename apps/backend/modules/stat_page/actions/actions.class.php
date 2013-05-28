<?php

require_once dirname(__FILE__).'/../lib/stat_pageGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/stat_pageGeneratorHelper.class.php';

/**
 * stat_page actions.
 *
 * @package    manymoney
 * @subpackage stat_page
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class stat_pageActions extends autoStat_pageActions
{
	public function executeDelete(sfWebRequest $request)
	{
		$request->checkCSRFProtection();

		$obRecord		= $this->getRoute()->getObject();

		$this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

		if ($this->getRoute()->getObject()->delete())
		{
			if($obRecord->getImage() != '') {
				@unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/news/'.$obRecord->getImage());
				@unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/news/thumb/'.$obRecord->getImage());
			}

			$this->getUser()->setFlash('notice', 'The item was deleted successfully.');
		}

		$this->redirect('@stat_page');
	}
}
