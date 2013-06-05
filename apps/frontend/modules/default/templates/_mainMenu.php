<?if($oCategories->count()) {?>
	<ul class="vert-nav">
		<?foreach($oCategories as $oCategory) {?>
			<li>
				<a href="<?=url_for('product_category_show', array('category_alias' => $oCategory->getAlias()));?>"><?=$oCategory->getName();?></a>
				<? if(isset($aSubcategories[$oCategory->getId()]) && count($aSubcategories[$oCategory->getId()])) {?>
					<ul>
						<? foreach ($aSubcategories[$oCategory->getId()] as $c) { ?>
							<li>
								<a href="<?=url_for('product_subcategory_show', array('category_alias' => $oCategory->getAlias(), 'subcategory_alias' => $c->getAlias()))?>">
									<?=$c->getName();?>
								</a>
							</li>
						<? } ?>
					</ul>
				<? } ?>
			</li>
		<?}?>
	</ul>
<?}?>