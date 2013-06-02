<?if($product_subcategory->getImage()) {
	echo image_tag('/uploads/product_subcategory/thumb/' . $product_subcategory->getImage(), array(
		'absolute' => true,
		'alt'	=> $product_subcategory->getName(),
		'title'	=> $product_subcategory->getName()
	));
} else {
	echo '<span>Отсутствует</span>';
}?>
