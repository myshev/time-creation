<?php

/**
 * Product
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    manymoney
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Product extends BaseProduct
{
	/**
	 * Для роутера (возвращает алиас с id
	 * @return string
	 */
	public function getAliasId() {
		return $this->getAlias() . "-" . $this->getId();
	}
}