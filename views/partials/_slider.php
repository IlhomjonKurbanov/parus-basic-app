<?php

use app\assets\SlickAsset;
use yii\helpers\Html;
use yii\web\View;

SlickAsset::register($this);
?>
<div class="widget-slider-list">
    <div class="slider-list-items">
        <?php foreach ($images as $image) :  ?>
            <div class="slider-list-item clearfix">
                <?=  Html::img($image->image_thumb_src, ['class' => 'img-responsive']) ?>
            </div>
        <?php endforeach;  ?>
    </div>
    <div class="slider-list-buttons">
        <div class="slider-list-prev">
            <i class="fa fa-angle-left"></i>
        </div>
        <div class="slider-list-next">
            <i class="fa fa-angle-right"></i>
        </div>
    </div>
</div>

<?php
    $js = "$(document).ready(function(){
            $('.slider-list-items').slick({
                infinite: true,
                slidesToShow: 5,
                slidesToScroll: 4,
                autoplay: true,
                prevArrow: $('.slider-list-prev'),
                nextArrow: $('.slider-list-next'),
            });
        });";
    
    $this->registerJs($js, View::POS_END, 'widget_slider_list');
?>