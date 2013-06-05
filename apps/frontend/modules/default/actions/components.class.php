<?

class defaultComponents extends sfComponents {

	/**
	 * Компонент вывода главного меню сайта
	 */
	public function executeMainMenu() {
		$this->oCategories	= ProductCategoryTable::getInstance()->getActiveList();
	}
}