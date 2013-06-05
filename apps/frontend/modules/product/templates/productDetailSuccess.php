<?if($oProduct) {?>
	<?=$oProduct->getName();?>
	<?=htmlspecialchars_decode($oProduct->getDescription());?>
<?}?>