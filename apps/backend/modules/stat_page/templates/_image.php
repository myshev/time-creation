<?if($stat_page->getImage()) {
	echo image_tag('/uploads/stat/thumb/' . $stat_page->getImage(), array(
		'absolute' => true,
		'alt'	=> $stat_page->getName(),
		'title'	=> $stat_page->getName()
	));
}?>
