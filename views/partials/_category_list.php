<?php
use yii\helpers\Url;
?>

<ul class="list-unstyled widget-category-nav-items">
    <?php foreach ($categories as $category) :?>
        <li class="widget-category-nav-item">
            <a href="<?= Url::to(['category/show', 'id' => $category->id]) ?>">
                <span class="widget-category-nav-item-text">
                    <?= $category->title ?>
                </span>
                <span class="widget-category-nav-item-count <?= $category->cat_type ?>">
                     <?= $category->post_count ?>
                </span>
            </a>
        </li>
    <?php endforeach; ?>
</ul>