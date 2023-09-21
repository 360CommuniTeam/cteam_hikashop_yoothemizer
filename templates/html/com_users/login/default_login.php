<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   (C) 2009 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\CMS\Router\Route;

/** @var \Joomla\Component\Users\Site\View\Login\HtmlView $cookieLogin */

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$wa = $this->document->getWebAssetManager();
$wa->useScript('keepalive')
    ->useScript('form.validate');

$usersConfig = ComponentHelper::getParams('com_users');

?>
<div class="com-users-login login">
    <?php if ($this->params->get('show_page_heading')) : ?>
    <div class="page-header">
        <h1>
            <?php echo $this->escape($this->params->get('page_heading')); ?>
        </h1>
    </div>
    <?php endif; ?>

    <?php if (($this->params->get('logindescription_show') == 1 && str_replace(' ', '', $this->params->get('login_description', '')) != '') || $this->params->get('login_image') != '') : ?>
    <div class="com-users-login__description login-description">
    <?php endif; ?>

        <?php if ($this->params->get('logindescription_show') == 1) : ?>
            <?php echo $this->params->get('login_description'); ?>
        <?php endif; ?>

        <?php if ($this->params->get('login_image') != '') : ?>
            <?php echo HTMLHelper::_('image', $this->params->get('login_image'), empty($this->params->get('login_image_alt')) && empty($this->params->get('login_image_alt_empty')) ? false : $this->params->get('login_image_alt'), ['class' => 'com-users-login__image login-image']); ?>
        <?php endif; ?>

    <?php if (($this->params->get('logindescription_show') == 1 && str_replace(' ', '', $this->params->get('login_description', '')) != '') || $this->params->get('login_image') != '') : ?>
    </div>
    <?php endif; ?>

    <form action="<?php echo Route::_('index.php?option=com_users&task=user.login'); ?>" method="post" class="com-users-login__form form-validate form-horizontal well" id="com-users-login__form">
        <div class="uk-form-horizontal">
            <fieldset>
                <div class="uk-margin com-users-login__input">
                    <label id="username-lbl" for="username" class="uk-form-label required"><?= Text::_('COM_USERS_LOGIN_USERNAME_LABEL');?></label>
                    <div class="uk-form-controls">
                        <input type="text" name="username" id="username" placeholder="<?= Text::_('COM_USERS_LOGIN_USERNAME_LABEL');?>" class="uk-input validate-username required">
                    </div>
                </div>
                <div class="uk-margin com-users-login__input">
                    <label id="password-lbl" for="password" class="uk-form-label required"><?= Text::_('JGLOBAL_PASSWORD');?></label>
                    <div class="uk-form-controls">
			
                        <div class="password-group">
                            <div class="uk-inline uk-width-1-1 input-group has-success">
                                <input type="password" name="password" id="password" value="" placeholder="<?= Text::_('JGLOBAL_PASSWORD');?>" class="form-control uk-input valid form-control-success" required="" data-min-force="1" autocomplete="current-password" aria-invalid="false">
                                <button class="uk-form-icon uk-form-icon-flip uk-input-password-toggle uk-icon" uk-icon="icon: eye">
                                    <span class="visually-hidden uk-hidden"><?= Text::_('JSHOWPASSWORD'); ?></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if (PluginHelper::isEnabled('system', 'remember')) : ?>
                           <div class="com-users-login__remember">
                        <div class="uk-form-controls uk-form-controls-text">
                            <label><input id="remember" class="uk-checkbox" type="checkbox" name="remember" value="yes"> Se souvenir de moi</label>
                        </div>
                    </div>
                <?php endif; ?>

                <?php foreach ($this->extraButtons as $button) :
                    $dataAttributeKeys = array_filter(array_keys($button), function ($key) {
                        return substr($key, 0, 5) == 'data-';
                    });
                    ?>
                    <div class="uk-margin com-users-login__submit control-group">
                        <div class="uk-form-controls controls">
                            <button type="button"
                                    class="uk-button uk-button-secondary w-100 <?php echo $button['class'] ?? '' ?>"
                                    <?php foreach ($dataAttributeKeys as $key) : ?>
                                        <?php echo $key ?>="<?php echo $button[$key] ?>"
                                    <?php endforeach; ?>
                                    <?php if ($button['onclick']) : ?>
                                    onclick="<?php echo $button['onclick'] ?>"
                                    <?php endif; ?>
                                    title="<?php echo Text::_($button['label']) ?>"
                                    id="<?php echo $button['id'] ?>"
                            >
                                <?php if (!empty($button['icon'])) : ?>
                                    <span class="<?php echo $button['icon'] ?>"></span>
                                <?php elseif (!empty($button['image'])) : ?>
                                    <?php echo HTMLHelper::_('image', $button['image'], Text::_($button['tooltip'] ?? ''), [
                                        'class' => 'icon',
                                    ], true) ?>
                                <?php elseif (!empty($button['svg'])) : ?>
                                    <?php echo $button['svg']; ?>
                                <?php endif; ?>
                                <?php echo Text::_($button['label']) ?>
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="uk-margin com-users-login__submit control-group">
                    <div class="uk-form-controls controls">
                        <button type="submit" class="uk-button uk-button-primary">
                            <?php echo Text::_('JLOGIN'); ?>
                        </button>
                    </div>
                </div>

                <?php $return = $this->form->getValue('return', '', $this->params->get('login_redirect_url', $this->params->get('login_redirect_menuitem', ''))); ?>
                <input type="hidden" name="return" value="<?php echo base64_encode($return); ?>">
                <?php echo HTMLHelper::_('form.token'); ?>
            </fieldset>
        </div>
    </form>
    <div class="com-users-login__options uk-list list-group" role="list">
        <a class="com-users-login__reset uk-display-block list-group-item" href="<?php echo Route::_('index.php?option=com_users&view=reset'); ?>" role="listitem">
            <?php echo Text::_('COM_USERS_LOGIN_RESET'); ?>
        </a>
        <a class="com-users-login__remind uk-display-block list-group-item" href="<?php echo Route::_('index.php?option=com_users&view=remind'); ?>" role="listitem">
            <?php echo Text::_('COM_USERS_LOGIN_REMIND'); ?>
        </a>
        <?php if ($usersConfig->get('allowUserRegistration')) : ?>
            <a class="com-users-login__register uk-display-block list-group-item" href="<?php echo Route::_('index.php?option=com_users&view=registration'); ?>" role="listitem">
                <?php echo Text::_('COM_USERS_LOGIN_REGISTER'); ?>
            </a>
        <?php endif; ?>
    </div>
</div>
