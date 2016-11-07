<?php

use app\assets\SlickAsset;
use yii\helpers\Html;
use yii\web\View;

SlickAsset::register($this);
?>
<div class="widget-slider-single">
    <div class="slider-single">
        <?php foreach ($gallery as $image) :  ?>
            <div class="slider-single-item clearfix">
                <?= Html::img($image->image_large_src, ['class' => 'img-responsive']) ?>
            </div>
        <?php endforeach;  ?>
    </div>
    <div class="slider-single-buttons">
        <div class="slider-single-prev">
            <i class="fa fa-angle-left"></i>
        </div>
        <div class="slider-single-next">
            <i class="fa fa-angle-right"></i>
        </div>
    </div>
</div>

<?php
    $js = "$(document).ready(function(){
            $('.slider-single').slick({
                prevArrow: $('.slider-single-prev'),
                nextArrow: $('.slider-single-next'),
                autoplay: false,
                fade: true,
                cssEase: 'linear'
            });
        });";
    
    $this->registerJs($js, View::POS_END, 'widget_slider_single');
?>