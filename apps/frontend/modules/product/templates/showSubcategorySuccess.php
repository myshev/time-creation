<strong><?=$oSubcategory->getName();?></strong>

<?if($oProducts->count()) {?>
	<ul>
		<?foreach($oProducts as $oProduct) {?>
			<?/*<li><a href="<?=url_for('product_detail');?>"><?=$oProduct->getProduct()->getName();?></a></li>*/?>
			<li><?=link_to($oProduct->getProduct()->getName(), 'product_detail', $oProduct->getProduct());?></li>
		<?}?>
	</ul>
<?}?>