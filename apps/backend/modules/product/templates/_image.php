<?if($product->getImage()) {
	echo image_tag('/uploads/product/thumb/' . $product->getImage(), array(
		'absolute' => true,
		'alt'	=> $product->getName(),
		'title'	=> $product->getName()
	));
} else {
	echo '<span>Отсутствует</span>';
}?>
