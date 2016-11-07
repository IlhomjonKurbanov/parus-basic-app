<?php

use yii\widgets\ListView;

$this->title = $category->title;
$this->registerMetaTag(['name' => 'description', 'content' => $category->meta_description], 'description');
?>

<div class="entry-listview-area">
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-xs-12">
                <div class="section-heading <?= $category->cat_type ?>">
                    <h3 class="section-heading-title">
                        <?= $category->title ?>
                    </h3>
                </div>
                <?= ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => '_entry',
                    'summary' => false,
                ]); ?>
            </div>
            <div class="col-sm-3 col-xs-12 side">
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