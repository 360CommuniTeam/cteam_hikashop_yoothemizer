<?php

namespace Cteam\Plugin\Yoothememodal;

use YOOtheme\Config;
use YOOtheme\Path;
use YOOtheme\Translator;

class SettingsListener
{
    public static function initCustomizer(Config $config, Translator $translator)
    {
        $config->addFile('customizer', Path::get('../config/customizer.json'));
        $translator->addResource(Path::get("../languages/{$config('locale.code')}.json"));
    }
}
