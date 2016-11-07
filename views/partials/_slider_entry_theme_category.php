<?php

use app\assets\SlickAsset;
use yii\helpers\Html;
use yii\web\View;
use yii\helpers\Url;

SlickAsset::register($this);
?>
<div class="entry-slide-category">
    <?php foreach ($entries as $entry) :  ?>
        <article class="entry-slide">
            <div class="entry-image entry-image-slide clearfix">
                <div class="entry-badge floated">
                    <span>
                        <a class="<?= $entry->category->cat_type ?>" href="<?= Url::to(['category/show', 'id' => $entry->category_id]) ?>">
                            <?= $entry->category->title ?>
                        </a>
                    </span>
                </div>
                <a href="<?= Url::to(['post/show', 'id' => $entry->id]) ?>"><?= Html::img($entry->image_small_src, ['class' => 'img-responsive']) ?> </a>
            </div>
            <h4 class="entry-title entry-title-list">
                <a href="<?= Url::to(['post/show', 'id' => $entry->id]) ?>"><?= $entry->title ?></a>
            </h4>
        </article>
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

<?php
    $js = "$(document).ready(function(){
            $('.entry-slide-category').slick({
                infinite: true,
                slidesToShow: 5,
//                autoplay: true,
                autoplaySpeed: 2000,
                prevArrow: $('.slider-list-prev'),
                nextArrow: $('.slider-list-next'),
                 responsive: [
                    {
                      breakpoint: 970,
                      settings: {
                        slidesToShow: 4,
                      }
                    },
                    {
                      breakpoint: 750,
                      settings: {
                        slidesToShow: 3,
                      }
                    },
                    {
                      breakpoint: 480,
                      settings: {
                        slidesToShow: 2,
                      }
                    }
                ]
            });
        });";
    
    $this->registerJs($js, View::POS_END, 'entry_slide_category');
?>