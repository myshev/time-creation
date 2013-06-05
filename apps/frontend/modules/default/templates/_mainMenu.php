<?if($oCategories->count()) {?>
	<ul class="vert-nav">
		<?foreach($oCategories as $oCategory) {?>
			<li>
				<a href=""><?=$oCategory->getName();?></a>
				<?if($oCategory->getProductSubcategory()->count()) {?>
					<ul>
						<?foreach($oCategory->getProductSubcategory() as $oSubcategory) {?>
							<li><a href=""><?=$oSubcategory->getName();?></a></li>
						<?}?>
					</ul>
				<?}?>
			</li>
		<?}?>
	</ul>
<?}?>