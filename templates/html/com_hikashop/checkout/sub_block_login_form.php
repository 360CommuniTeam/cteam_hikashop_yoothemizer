<?php
/**
 * @package	HikaShop for Joomla!
 * @version	4.7.4
 * @author	hikashop.com
 * @copyright	(C) 2010-2023 HIKARI SOFTWARE. All rights reserved.
 * @license	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
defined('_JEXEC') or die('Restricted access');
?><?php

if(JPluginHelper::isEnabled('authentication', 'openid')) {
	$lang = JFactory::getLanguage();
	$lang->load('plg_authentication_openid', JPATH_ADMINISTRATOR);
	$langScript = 'var JLanguage = {};'."\r\n".
		' JLanguage.WHAT_IS_OPENID = \''.JText::_('WHAT_IS_OPENID').'\';'."\r\n".
		' JLanguage.LOGIN_WITH_OPENID = \''.JText::_('LOGIN_WITH_OPENID').'\';'."\r\n".
		' JLanguage.NORMAL_LOGIN = \''.JText::_('NORMAL_LOGIN').'\';'."\r\n".
		' var comlogin = 1;';
	$doc = JFactory::getDocument();
	$doc->addScriptDeclaration($langScript);
	JHTML::_('script', 'openid.js');
}

$reset_url = 'index.php?option=com_users&view=reset';
$remind_url = 'index.php?option=com_users&view=remind';

if(!HIKASHOP_RESPONSIVE) {
	$labelcolumnclass = 'hkc-sm-4';
	$inputcolumnclass = 'hkc-sm-8';
?>
<div class="uk-form-horizontal">
	<fieldset class="">
	<!-- TOP OLD EXTRA DATA -->
	<?php
	if(!empty($this->extraData[$this->module_position]) && !empty($this->extraData[$this->module_position]->loginTop)) { echo implode("\r\n", $this->extraData[$this->module_position]->loginTop); }
	?>
	<!-- EO OLD TOP EXTRA DATA -->
	<!-- OLD USERNAME -->
		<div class="uk-margin hikashop_login_username_line">
			<label for="username" class="uk-form-label hkcontrol-label"><?php echo JText::_('HIKA_USERNAME') ?></label>
			<div class="uk-form-controls">
				<input type="text" id="username" placeholder="<?= JText::_('HIKA_USERNAME') ?>" name="login[username]" class="uk-input" alt="<?= JText::_('HIKA_USERNAME') ?>"/>
			</div>
		</div>
	<!-- EO OLD USERNAME -->
	<!-- OLD PASSWORD -->
		<div class="uk-margin hikashop_login_password_line">
			<label for="passwd" class="uk-form-label hkcontrol-label"><?php echo JText::_('HIKA_PASSWORD') ?></label>
			<div class="uk-form-controls">
			<?php
				$layout = new JLayoutFile('joomla.form.field.password');
				echo $layout->render(array(
					'meter' => false,
					'class' => 'uk-input',
					'forcePassword' => true,
					'lock' => false,
					'rules' => false,
					'hint' => JText::_('HIKA_PASSWORD'),
					'readonly' => false,
					'disabled' => false,
					'required' => true,
					'autofocus' => false,
					'dataAttribute' => 'autocomplete="current-password"',
					'name' => 'login[passwd]',
					'id' => 'passwd',
					'value' => '',
				));
  			?>
			</div>
		</div>
	<!-- EO OLD PASSWORD -->
	<!-- OLD REMEMBER ME -->
	<?php
		if(JPluginHelper::isEnabled('system', 'remember')) {
	?>

		<div class="uk-margin hikashop_login_remember_line">
			<div class="uk-form-controls uk-form-controls-text">
				<label><input id="remember" class="uk-checkbox" type="checkbox" name="login[remember]" value="yes" > <?= JText::_('HIKA_REMEMBER_ME') ?></label>
			</div>
		</div>

	<?php
		}
	?>
	<!-- EO OLD REMEMBER ME -->
	<!-- OLD SOCIAL BUTTONS -->
	<?php
		$this->setLayout('sub_block_login_social');
		echo $this->loadTemplate();
	?>
	<!-- EO OLD SOCIAL BUTTONS -->
	<!-- OLD LOGIN BUTTON -->
		<div class="uk-margin hikashop_login_button_line">
			<div class="uk-form-controls">
				<button
					type="submit"
					onclick="window.checkout.submitLogin(<?php echo $this->step; ?>,<?php echo $this->module_position; ?>, 'login'); return false;"
					class="uk-button uk-button-primary <?= $this->config->get('css_button','hikabtn'); ?> hikabtn_checkout_login_form"
				>
					<?php echo JText::_('HIKA_LOGIN'); ?>
				</button>
			</div>
		</div>
	<!-- EO OLD LOGIN BUTTON -->
	<!-- OLD FORGOT PASSWORD -->
		<div class="hkform-group control-group hikashop_login_forgot_password_line">
			<div class="uk-form-label  hkcontrol-label"></div>
			<div class=" uk-form-controls">
				<a href="<?php echo JRoute::_( $reset_url ); ?>">
					<?php echo JText::_('HIKA_FORGOT_YOUR_PASSWORD'); ?>
				</a>
			</div>
		</div>
	<!-- EO OLD FORGOT PASSWORD -->
	<!-- OLD FORGOT USERNAME -->
		<div class="hkform-group control-group hikashop_login_forgot_username_line">
			<div class="uk-form-label  hkcontrol-label"></div>
			<div class=" uk-form-controls">
				<a href="<?php echo JRoute::_( $remind_url ); ?>">
					<?php echo JText::_('HIKA_FORGOT_YOUR_USERNAME'); ?>
				</a>
			</div>
		</div>
	<!-- EO OLD FORGOT USERNAME -->
	<!-- OLD BOTTOM EXTRA DATA -->
	<?php
	if(!empty($this->extraData[$this->module_position]) && !empty($this->extraData[$this->module_position]->loginBottom)) { echo implode("\r\n", $this->extraData[$this->module_position]->loginBottom); }
	?>
	<!-- EO OLD BOTTOM EXTRA DATA -->
	</fieldset>
</div>
<?php

} else {

?>
<div class="userdata form-inline">
<!-- TOP EXTRA DATA -->
<?php
if(!empty($this->extraData[$this->module_position]) && !empty($this->extraData[$this->module_position]->loginTop)) { echo implode("\r\n", $this->extraData[$this->module_position]->loginTop); }
?>
<!-- EO TOP EXTRA DATA -->
<!-- USERNAME -->
	<div id="form-login-username" class="control-group">
		<div class="controls">
			<div class="input-prepend input-append">
				<span class="add-on">
					<i class="icon-user tip" title="<?php echo JText::_('HIKA_USERNAME'); ?>"></i>
					<label for="modlgn-username" class="element-invisible"><?php echo JText::_('HIKA_USERNAME'); ?></label>
				</span>
				<input id="modlgn-username" type="text" name="login[username]" class="input-small" tabindex="1" size="18" placeholder="<?php echo JText::_('HIKA_USERNAME'); ?>" />
				<a href="<?php echo JRoute::_( $remind_url );?>" class="btn hasTooltip" title="<?php echo JText::_('HIKA_FORGOT_YOUR_USERNAME'); ?>"><i class="icon-question-sign"></i></a>
			</div>
		</div>
	</div>
<!-- EO USERNAME -->
<!-- PASSWORD -->
	<div id="form-login-password" class="control-group">
		<div class="controls">
			<div class="input-prepend input-append">
				<span class="add-on">
					<i class="icon-lock tip" title="<?php echo JText::_('HIKA_PASSWORD') ?>"></i>
					<label for="modlgn-passwd" class="element-invisible"><?php echo JText::_('HIKA_PASSWORD') ?></label>
				</span>
				<input id="modlgn-passwd" type="password" name="login[passwd]" class="input-small" tabindex="2" size="18" placeholder="<?php echo JText::_('HIKA_PASSWORD') ?>" />
				<a href="<?php echo JRoute::_( $reset_url );?>" class="btn hasTooltip" title="<?php echo JText::_('HIKA_FORGOT_YOUR_PASSWORD'); ?>"><i class="icon-question-sign"></i></a>
			</div>
		</div>
	</div>
<!-- EO PASSWORD -->
<!-- REMEMBER ME -->
<?php
	if(JPluginHelper::isEnabled('system', 'remember')) {
?>
	<div id="form-login-remember" class="control-group checkbox">
		<label for="modlgn-remember" class="control-label"><?php echo JText::_('HIKA_REMEMBER_ME') ?></label>
		<input id="modlgn-remember" type="checkbox" name="login[remember]" value="yes"/>
	</div>
<?php
	}
?>
<!-- EO REMEMBER ME -->
<!-- SOCIAL BUTTONS -->
<?php
	$this->setLayout('sub_block_login_social');
	echo $this->loadTemplate();
?>
<!-- EO SOCIAL BUTTONS -->
<!-- LOGIN BUTTON -->
	<div id="form-login-submit" class="control-group">
		<div class="controls">
			<button type="submit" onclick="window.checkout.submitLogin(<?php echo $this->step; ?>,<?php echo $this->module_position; ?>, 'login'); return false;" class="<?php echo $this->config->get('css_button','hikabtn'); ?> hikabtn_checkout_login_form"><?php
				echo JText::_('HIKA_LOGIN');
			?></button>
		</div>
	</div>
<!-- EO LOGIN BUTTON -->
<!-- FORGOT PASSWORD -->
	<div class="control-group hikashop_login_forgot_password_line">
		<div class="controls">
			<a href="<?php echo JRoute::_( $reset_url ); ?>">
				<?php echo JText::_('HIKA_FORGOT_YOUR_PASSWORD'); ?>
			</a>
		</div>
	</div>
<!-- EO FORGOT PASSWORD -->
<!-- FORGOT USERNAME -->
	<div class="control-group hikashop_login_forgot_username_line">
		<div class="controls">
			<a href="<?php echo JRoute::_( $remind_url ); ?>">
				<?php echo JText::_('HIKA_FORGOT_YOUR_USERNAME'); ?>
			</a>
		</div>
	</div>
<!-- EO FORGOT USERNAME -->
<!-- BOTTOM EXTRA DATA -->
<?php
if(!empty($this->extraData[$this->module_position]) && !empty($this->extraData[$this->module_position]->loginBottom)) { echo implode("\r\n", $this->extraData[$this->module_position]->loginBottom); }
?>
<!-- EO BOTTOM EXTRA DATA -->
</div>
<?php
	}
