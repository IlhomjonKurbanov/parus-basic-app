<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Parus home page';
?>

<section class="main-slider-area section-medium-margin">
    <div class="row">
        <div class="col-sm-12">
            <div class="main-slider-items">
                <?php $album = get_album_by('alias', 'main_slider', ['with' => 'photo']); ?>
                <?php if (!is_null($album) && !empty($galley = $album->photos)) :  ?>
                    <?= $this->render('../partials/_slider_single', [
                        'gallery' => $galley
                    ]) ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<section class="main-entry-area section-medium-margin">
    <?php $entry = get_post_by('id', '10', ['with' => 'category']);  ?>
    <div class="row">
        <div class="col-md-9">
            <section class="section-head-entry-area section-medium-margin">
                <div class="section-heading">
                    <h3 class="section-heading-title">
                        <?= Yii::t('app', 'Entry') ?>
                    </h3>
                </div>
                <?php if ($entry) : ?>
                    <div class="entry-head">
                        <?= Html::img($entry->image_large_src, ['class' => 'img-responsive entry-head-image'])?>
                        <div class="entry-head-overlay">
                            <div class="entry-head-content">
                                <span class="entry-meta-category entry-meta-category-head">
                                    <a href="<?= Url::to(['category/show', 'id' => $entry->category->id]) ?>">
                                        <?= $entry->category->title ?>
                                    </a>
                                </span>
                                <h3 class="entry-title entry-title-head">
                                    <a class="entry-title-head-link" href="<?= Url::to(['post/show', 'id' => $entry->id]) ?>"><?= $entry->title ?></a>
                                </h3>
                                <div class="entry-meta entry-meta-head">
                                    <div class="entry-meta-item entry-meta-date-head">
                                        <i class="fa fa-clock-o"></i>
                                        <span><?= $entry->published_at_relative ?></span>
                                    </div>
                                    <div class="entry-meta-item entry-meta-count-head">
                                        <i class="fa fa-eye"></i>
                                        <span><?= $entry->hits  ?> <?= Yii::t('app', 'Views') ?> </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif;  ?>
            </section>
        </div>
        <div class="col-md-3">
            <section class="section-right-now-area section-medium-margin">
                <div class="section-heading">
                    <h3 class="section-heading-title">
                        <?= Yii::t('app', 'Right now') ?>
                    </h3>
                </div>
                <?php if (!empty($lastPost = get_last_post(5))) :  ?>
                    <?= $this->render('../partials/_entry_list_theme_date', [
                        'header' => Yii::t('app', 'Right now'),
                        'entries' => $lastPost
                    ]) ?>
                <?php endif; ?>
            </section>
        </div>
    </div>
</section>

<section class="category-entry-area section-medium-margin">
    <div class="row">
        <?php if (!empty($categories = get_category_by('alias', ['cloud', 'mobility', 'tech'], ['post_group_limit' => 4, 'with' => 'post']))) : ?>
            <?php foreach($categories as $category) : ?>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="section-heading <?= $category->cat_type ?>">
                        <h3 class="section-heading-title">
                            <?= $category->title ?>
                        </h3>
                    </div>
                    <?php
                        $posts = $category->posts;
                        $firstEntry = array_shift($posts);
                    ?>
                    <?php if (!empty($firstEntry)) : ?>
                        <article>
                            <div class="entry-image entry-image-first clearfix">
                                <a href="<?= Url::to(['post/show', 'id' => $firstEntry->id]) ?>"><?= Html::img($firstEntry->image_small_src, ['class' => 'img-responsive']) ?> </a>
                            </div>
                            <h3 class="entry-title entry-title-first">
                                <a href="<?= Url::to(['post/show', 'id' => $firstEntry->id]) ?>"><?= $firstEntry->title ?></a>
                            </h3>
                            <div class="entry-meta entry-meta-first">
                                <span class="time"><?= $firstEntry->published_at ?></span>
                            </div>
                            <div class="entry-content entry-content-first">
                                <?= $firstEntry->introtext ?>
                            </div>
                        </article>
                    <?php endif; ?>
                    <div class="entry-list">
                        <?php foreach($posts as $entry) : ?>

                            <article class="entry-item-list">
                                <div class="entry-image-list">
                                    <a href="<?= Url::to(['post/show', 'id' => $entry->id]) ?>">
                                        <?= Html::img($entry->image_thumb_src, ['class' => 'media-object']) ?>
                                    </a>
                                </div>
                                <div class="entry-body-list">
                                    <h4 class="entry-title entry-title-list">
                                        <a href="<?= Url::to(['post/show', 'id' => $entry->id]) ?>">
                                            <?= $entry->title ?>
                                        </a>
                                    </h4>
                                    <div class="entry-meta entry-meta-list">
                                        <span class="time"><?= $entry->published_at ?></span>
                                    </div>
                                </div>
                            </article>

                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>

<section class="popular-entry-area section-medium-margin">
    <div class="row">
        <div class="col-sm-12">
            <div class="section-heading">
                <h3 class="section-heading-title">
                    <?= Yii::t('app', 'Popular post') ?>
                </h3>
            </div>
        </div>
        <?php if (!empty($popularPost = get_popular_post(7, ['with' => 'category']))) : ?>
            <div class="col-sm-12">
                <?= $this->render('../partials/_slider_entry_theme_category', [
                    'entries' => $popularPost
                ]) ?>
            </div>
        <?php endif;  ?>
    </div>
</section>