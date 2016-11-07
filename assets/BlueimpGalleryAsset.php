<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * BlueimpGalleryAsset
 *
 * @author Roman Korolov <rokorolov@gmail.com>
 */
class BlueimpGalleryAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'plugins/blueimpgallery/css/blueimp-gallery.min.css',
    ];
    public $js = [
        'plugins/blueimpgallery/js/blueimp-gallery.min.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
