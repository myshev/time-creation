<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
  	<div id="header">
		<? $class = sfConfig::get('app_sf_guard_plugin_signin_form', 'sfGuardFormSignin'); // получаем объект формы
		$form = new $class();?>
		<? if(!$sf_user->isAuthenticated()) {?>
			<?=get_partial('sfGuardAuth/signin_form', array('form' => $form)) ?>

			<a href="<?=url_for('sf_guard_register');?>" title="<?=__('Зарегаться');?>">Зарегаться</a>
		<? } else { ?>
			<span><?=__('Здравствуйте');?>, <?=$sf_user->getName();?> <?=$sf_user->getAttribute( 'email_address', null, 'sfGuardSecurityUser');?></span>
			&nbsp;
			<?=link_to(__('Выход'), 'sf_guard_signout'); ?>
		<? } ?>
  	</div>
	<div class="clear"></div>
  	<div>
		<?include_component('default', 'mainMenu');?>
  	</div>
	<div class="clear"></div>
    <?php echo $sf_content ?>
  </body>
</html>
