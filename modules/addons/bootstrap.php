<?php



include_once __DIR__ . '/src/AssetsListener.php';
include_once __DIR__ . '/src/SettingsListener.php';
include_once __DIR__ . '/src/SourceListener.php';
include_once __DIR__ . '/src/StyleListener.php';

use YOOtheme\Builder;
use YOOtheme\Path;
use YOOtheme\Theme\Styler\StylerConfig;
use YOOtheme\Translator;

use Cteam\Plugin\HikashopYOOThemizer\AssetsListener;
use Cteam\Plugin\HikashopYOOThemizer\SettingsListener;
use Cteam\Plugin\HikashopYOOThemizer\SourceListener;
use Cteam\Plugin\HikashopYOOThemizer\StyleListener;

return [

    'theme' => [
        'styles' => [
            'components' => [],
        ],
    ],

    'events' => [

        // Add asset files
        'theme.head' => [
            AssetsListener::class => 'initHead',
        ],

        // Add settings Panels
        'customizer.init' => [
            SettingsListener::class => 'initCustomizer'
        ],

        // Add custom demo source
        'source.init' => [
            SourceListener::class => 'initSource',
        ],
        //StylerConfig::class => [StyleListener::class => 'config'],
    ],

    'config' => [ 
        StylerConfig::class => __DIR__ . '/config/styler.json',
    ],

    // Add builder elements
    'extend' => [

        Builder::class => function (Builder $builder) {
            $builder->addTypePath(Path::get('./elements/*/element.json'));
        },

    ],

];

class CteamHikashopYOOThemeTranslator {

    function initCustomizer(Config $config, Translator $translator) {

        $translator->addResource(Path::get("./languages/{$config('locale.code')}.json"));

    }

}