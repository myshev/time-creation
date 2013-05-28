<?if($news->getImage()) {
	echo image_tag('/uploads/news/thumb/' . $news->getImage(), array(
		'absolute' => true,
		'alt'	=> $news->getName(),
		'title'	=> $news->getName()
	));
}?>
