<?php


namespace Cteam\Plugin\Yoothememodal;

use YOOtheme\Metadata;
use YOOtheme\Path;


class AssetsListener
{
    public static function initHead(Metadata $metadata)
    {
        // Style file
        $metadata->set('style:modal-custom-css', ['href' => Path::get('../assets/css/custom.css')]);


        // Script file
        $metadata->set('script:modal-custom-js', ['src' => Path::get('../assets/js/custom.js'), 'defer' => true]);

    }
}
