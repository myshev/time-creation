<?php

/**
 * ProductTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ProductTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object ProductTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Product');
    }

	public function getActiveById($iProductId) {
		if((int) $iProductId) {
			$oResult = $this->createQuery('p')->where( 'p.id = ?', $iProductId );
			return $oResult->fetchOne();
		}
		return false;
	}

	public function getProductsForProductLink($iProductId) {
		if((int) $iProductId) {
			$oResult = $this->createQuery('p')->where( 'p.id <> ?', $iProductId )->execute();
		} else {
			$oResult = $this->createQuery('p')->execute();
		}

		if($oResult->count()) {
			foreach($oResult as $choice){
				$choices[$choice->getId()] = $choice;
			}
			return $choices;
		}
		return array();
	}

	public function getBySubcategory($iSubcategoryId) {
		if((int) $iSubcategoryId > 0) {
			$oResult	= $this->createQuery('p')
							->where('p.product_subcategory_id = ?', $iSubcategoryId)
							->andWhere('p.is_active = ?', 1);
			return $oResult->execute();
		}
		return false;
	}
}