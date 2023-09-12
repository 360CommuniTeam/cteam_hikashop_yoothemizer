<?php

defined('DS') or define('DS', DIRECTORY_SEPARATOR);

use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\CMSPlugin;
use YOOtheme\Application;


class plgSystemCTeam_Hikashop_Yoothemizer extends CMSPlugin {

	public function onBeforeInitialise() {

	}
  public function onAfterInitialise() {
    if (!class_exists(Application::class, false)) {
        return;
    }

    $app = Application::getInstance();
    $app->load(__DIR__ . '/modules/*/bootstrap.php');
  }

}


?>
