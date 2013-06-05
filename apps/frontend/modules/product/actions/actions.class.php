<?php

/**
 * product actions.
 *
 * @package    manymoney
 * @subpackage product
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class productActions extends sfActions
{
	/**
	 * Executes index action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeIndex(sfWebRequest $request) {

	}

	/**
	 * Детальная страница категории
	 *
	 * @param sfWebRequest $request
	 */
	public function executeShowCategory(sfWebRequest $request) {
		$this->oCategory				= ProductCategoryTable::getInstance()->getActiveByAlias($request->getParameter('category_alias'));
		$this->forward404Unless($this->oCategory);
	}

	/**
	 * Детальная страница подкатегории
	 *
	 * @param sfWebRequest $request
	 */
	public function executeShowSubcategory(sfWebRequest $request) {
		$this->oSubcategory		= ProductSubcategoryTable::getInstance()->getActiveByCatAndSubCatAliases(
													$request->getParameter('category_alias'),
													$request->getParameter('subcategory_alias')
											);
		$this->forward404Unless($this->oSubcategory);

		$this->oProducts				= ProductSubcategory2ProductTable::getInstance()->getBySubcategory($this->oSubcategory->getId());
	}
}
