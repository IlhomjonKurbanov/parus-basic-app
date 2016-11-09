<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<?php foreach($entries as $entry) : ?>
    <article class="entry-item-list clearfix">
        <div class="entry-image-list">
            <a href="<?= Url::to(['post/show', 'id' => $entry->id]) ?>">
                <?= Html::img($entry->image_thumb_src, ['class' => 'media-object img-responsive']) ?>
            </a>
        </div>
        <div class="entry-body-list">
            <span class="entry-meta-category entry-meta-category-listview">
                <a class="<?= $entry->category->cat_type ?>" href="<?= Url::to(['category/show', 'id' => $entry->category->id]) ?>">
                    <?= $entry->category->title ?>
                </a>
            </span>
            <h4 class="entry-title entry-title-list">
                <a href="<?= Url::to(['post/show', 'id' => $entry->id]) ?>">
                    <?= $entry->title ?>
                </a>
            </h4>
        </div>
    </article>
<?php endforeach; ?>