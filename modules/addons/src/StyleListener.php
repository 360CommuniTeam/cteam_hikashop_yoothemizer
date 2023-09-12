<?php 

namespace Cteam\Plugin\Yoothememodal;

use YOOtheme\Theme\Styler\StylerConfig;

class StyleListener
{
    public static function config(StylerConfig $config): StylerConfig
    {
        //if (/* Your conditional code */) {
            // Style needs to be re-compiled
            $config['update'] = true;
        //}

        return $config;
    }
}

?>