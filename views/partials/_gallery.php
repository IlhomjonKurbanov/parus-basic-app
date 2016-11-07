<?php

use app\assets\BlueimpGalleryAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

BlueimpGalleryAsset::register($this);
?>

<div class="widget-gallery">
    <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
        <div class="slides"></div>
        <h3 class="title"></h3>
        <a class="prev">‹</a>
        <a class="next">›</a>
        <a class="close">×</a>
        <a class="play-pause"></a>
        <ol class="indicator"></ol>
    </div>
    <div id="gallery-items">
        <div class="row">
            <?php $i = 1;?>
            <?php foreach($images as $image) : ?>
                <div class="col-sm-2 col-xs-2 gallery-item">
                    <a href="<?= Url::to($image->image_src) ?>" title="skidras-tapetes">
                        <?= Html::img($image->image_thumb_src, ['alt' => 'skidras-tapetes', 'class' => 'img-responsive']) ?>
                    </a>
                </div>
            <?php if ($i === 6): ?>
                </div><div class="row">
            <?php
                endif;
                $i++;
            ?>
            <?php endforeach;  ?>
        </div>
    </div>
</div>

<?php
    $js = "document.getElementById('gallery-items').onclick = function (event) {
        event = event || window.event;
        var target = event.target || event.srcElement,
            link = target.src ? target.parentNode : target,
            options = {index: link, event: event},
            links = this.getElementsByTagName('a');
        blueimp.Gallery(links, options);
    };";
    
    $this->registerJs($js, View::POS_END, 'widget_gallery');
?>
