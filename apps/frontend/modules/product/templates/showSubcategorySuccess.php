<strong><?=$oSubcategory->getName();?></strong>

<?if($oProducts->count()) {?>
	<ul>
		<?foreach($oProducts as $oProduct) {?>
			<li><?=$oProduct->getProduct()->getName();?></li>
		<?}?>
	</ul>
<?}?>