<?if($product_category->getImage()) {
	echo image_tag('/uploads/product_category/thumb/' . $product_category->getImage(), array(
		'absolute' => true,
		'alt'	=> $product_category->getName(),
		'title'	=> $product_category->getName()
	));
} else {
	echo '<span>Отсутствует</span>';
}?>
