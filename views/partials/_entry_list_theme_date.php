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
            <h4 class="entry-title entry-title-list">
                <a href="<?= Url::to(['post/show', 'id' => $entry->id]) ?>">
                    <?= $entry->title ?>
                </a>
            </h4>
            <div class="entry-meta entry-meta-list">
                <span class="time"><?= $entry->published_at_relative ?></span>
            </div>
        </div>
    </article>
<?php endforeach; ?>