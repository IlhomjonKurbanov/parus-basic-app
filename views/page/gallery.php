<?php

$this->title = Yii::t('app', 'Gallery');

$gallery = get_album_by('alias', 'gallery', ['with' => 'photo']);
?>

<section class="lightbox-image-gallery section-medium-margin">
    <div class="section-heading">
        <h3 class="section-heading-title">
            <?= Yii::t('app', 'Lightbox gallery') ?>
        </h3>
    </div>
    <?php if ($gallery && !empty($images = $gallery->photos)) : ?>
        <?= $this->render('../partials/_gallery', [
            'images' => $images
        ]) ?>
    <?php endif;  ?>
</section>

<section class="image-slider-single section-medium-margin">
    <div class="row">
        <div class="col-sm-12">
            <div class="section-heading">
                <h3 class="section-heading-title">
                    <?= Yii::t('app', 'Single Slider') ?>
                </h3>
            </div>
        </div>
        <div class="col-sm-12">
            <?php $mainSlider = get_album_by('alias', 'main_slider', ['with' => 'photo']) ?>
            <?php if ($mainSlider && !empty($images = $mainSlider->photos)) : ?>
                <?= $this->render('../partials/_slider_single', [
                    'gallery' => $images
                ]) ?>
            <?php endif;  ?>
        </div>
    </div>
</section>

<section class="image-slider section-medium-margin">
    <div class="row">
        <div class="col-sm-12">
            <div class="section-heading">
                <h3 class="section-heading-title">
                    <?= Yii::t('app', 'Image Slider') ?>
                </h3>
            </div>
        </div>
        <div class="col-sm-12">
            <?php if ($gallery && !empty($images = $gallery->photos)) : ?>
                <?= $this->render('../partials/_slider', [
                    'images' => $images
                ]) ?>
            <?php endif;  ?>
        </div>
    </div>
</section>




