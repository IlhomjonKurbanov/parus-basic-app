<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * SlickAsset
 *
 * @author Roman Korolov <rokorolov@gmail.com>
 */
class SlickAsset extends AssetBundle
{
    public $sourcePath = '@bower/slick-carousel';
    public $css = [
        'slick/slick.css',
        'slick/slick-theme.css',
    ];
    public $js = [
        'slick/slick.min.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
