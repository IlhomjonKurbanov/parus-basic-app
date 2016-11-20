<?php

use app\assets\BlueimpGalleryAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

BlueimpGalleryAsset::register($this);
/**
 * @var $images \app\presenters\PhotoPresenter[]
 */
?>
<div class="widget-gallery">
    <div class="blueimp-gallery blueimp-gallery blueimp-gallery-controls">
        <div class="slides"></div>
        <h3 class="title"></h3>
        <a class="prev">‹</a>
        <a class="next">›</a>
        <a class="close">×</a>
        <a class="play-pause"></a>
        <ol class="indicator"></ol>
    </div>
    <div class="gallery-items">
        <div class="row">
            <?php $i = 1;?>
            <?php foreach($images as $image) : ?>
                <div class="col-sm-2 col-xs-2 gallery-item">
                    <a href="<?= Url::to($image->image_src) ?>" title="<? # TODO: `title` and `alt` from image caption ?>">
                        <?= Html::img($image->image_thumb_src, ['alt' => '', 'class' => 'img-responsive']) ?>
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
    $js = "
        ;(function(){
        var galleries = document.getElementsByClassName('gallery-items');
        for (var gal in galleries) { 
            galleries[gal].onclick = function (event) {
                event = event || window.event;
                var target = event.target || event.srcElement,
                    link = target.src ? target.parentNode : target,
                    options = {
                        index: link,
                        event: event,
                        container: this.parentElement.getElementsByClassName('blueimp-gallery')
                    },
                    links = this.getElementsByTagName('a');
                blueimp.Gallery(links, options);
            };
        }
        })();
    ";
    $this->registerJs($js, View::POS_END, 'widget_gallery');
?>
