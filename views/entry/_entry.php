<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<article class="entry-single-listview clearfix">
    <?php if (!empty($model->image)) : ?>
        <div class="entry-image entry-image-listview">
            <a href="<?= Url::to(['post/show', 'id' => $model->id]) ?>">
                <?= Html::img($model->image_small_src, ['class' => 'media-object img-responsive']) ?>
            </a>
        </div>
    <?php endif; ?>
    
    <div class="entry-body-listview">
        <span class="entry-meta-category entry-meta-category-listview">
            <a href="<?= Url::to(['category/show', 'id' => $model->category_id]) ?>">
                <?= $model->category_title ?>
            </a>
        </span>
        <h2 class="entry-title entry-title-listview">
            <a href="<?= Url::to(['post/show', 'id' => $model->id]) ?>">
                <?= $model->title ?>
            </a>
        </h2>
        <div class="entry-meta entry-meta-listview">
            <div class="entry-meta-item entry-meta-date-listview">
                <i class="fa fa-clock-o"></i>
                <span><?= $model->published_at_relative ?></span>
            </div>
            <div class="entry-meta-item entry-meta-count-view">
                <i class="fa fa-eye"></i>
                <span><?= $model->hits  ?>  <?= Yii::t('app', 'Views') ?> </span>
            </div>
        </div>
        <div class="entry-content-listview">
            <?= $model->introtext; ?>
        </div>
    </div>
</article>