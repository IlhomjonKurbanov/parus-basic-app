<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $entry->title;
$this->registerMetaTag(['name' => 'description', 'content' => $entry->meta_description], 'description');
?>
<div class="entry-view-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9">
                <article>
                    <span class="entry-meta-category entry-meta-category-view">
                        <a href="<?= Url::to(['category/show', 'id' => $entry->category->id]) ?>">
                            <?= $entry->category->title ?>
                        </a>
                    </span>

                    <h2 class="entry-title entry-title-view">
                        <?= $entry->title ?>
                    </h2>

                    <div class="entry-meta entry-meta-view">
                        <div class="entry-meta-item entry-meta-date-view">
                            <i class="fa fa-clock-o"></i>
                            <span><?= $entry->published_at_relative ?></span>
                        </div>
                        <div class="entry-meta-item entry-meta-count-view">
                            <i class="fa fa-eye"></i>
                            <span> <?= $entry->hits  ?> <?= Yii::t('app', 'Views') ?> </span>
                        </div>
                    </div>
                    
                    <?php if (!empty($entry->image)) : ?>
                        <div class="entry-image entry-image-view">
                            <a class="popup-image popup-image-default" href="<?= $entry->image_src() ?>">
                                <?= Html::img($entry->image_large_src, ['class' => 'media-object']) ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <div class="entry-content-view">
                        <?= $entry->fulltext; ?>
                    </div>
                </article>
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="widget widget-category-nav">
                    <div class="section-heading">
                        <h3 class="section-heading-title">
                            <?= Yii::t('app', 'Category') ?>
                        </h3>
                    </div>
                    <?php if (!empty($categories = get_category(['with' => 'post_count', 'depth' => 1, 'exclude' => 'uncategorised']))) : ?>
                        <?= $this->render('../partials/_category_list', [
                            'categories' => $categories
                        ]) ?>
                    <?php endif;  ?>
                </div>
                <div class="widget widget-entry-list">
                    <div class="section-heading">
                        <h3 class="section-heading-title">
                            <?= Yii::t('app', 'Popular Post') ?>
                        </h3>
                    </div>
                    <?php if (!empty($popularPost = get_popular_post(5, ['with' => 'category']))) : ?>
                        <?= $this->render('../partials/_entry_list', [
                            'entries' => $popularPost
                        ]) ?>
                    <?php endif;  ?>
                </div>
            </div>
        </div>
    </div>
</div>