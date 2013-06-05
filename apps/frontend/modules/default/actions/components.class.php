<?

class defaultComponents extends sfComponents {

	/**
	 * Компонент вывода главного меню сайта
	 */
	public function executeMainMenu() {
		$this->oCategories	= ProductCategoryTable::getInstance()->getActiveList();

		$this->aSubcategories = array();

        $this->oSubcategories = ProductSubcategoryTable::getInstance()->getActiveList();

		foreach ($this->oSubcategories as $val) {
				$this->aSubcategories[$val->getProductCategoryId()][] = $val;
		}

	}
}