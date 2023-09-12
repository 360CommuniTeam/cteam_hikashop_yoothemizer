<?php


namespace Cteam\Plugin\HikashopYOOThemizer;

use YOOtheme\Metadata;
use YOOtheme\Path;


class AssetsListener
{
    public static function initHead(Metadata $metadata)
    {
        // Style file
        $metadata->set('style:hk-yt-custom-css', ['href' => Path::get('../assets/css/custom.css')]);


        // Script file
        $metadata->set('script:hk-yt-custom-js', ['src' => Path::get('../assets/js/custom.js'), 'defer' => true]);

    }
}
