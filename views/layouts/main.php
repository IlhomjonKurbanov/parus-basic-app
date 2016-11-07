<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <header class="header-area">
        <div class="header-topbar">
            <div class="container">
                    <div class="header-topbar-left pull-left">
                        <ul class="list-inline list-unstyled header-login">
                            <li>
                                <a class="header-login-link" href="/admin">Login admin / password</a>
                            </li>
                        </ul>
                    </div>
                    <div class="header-topbar-right pull-right">
                        <ul class="list-inline list-unstyled header-social-links">
                            <li>
                                <a class="header-social-link" target="_blank" href="https://github.com/rokorolov/parus-basic-app"><i class="fa fa-github" aria-hidden="true"></i></a>
                            </li>
                        </ul>
                    </div>
            </div>
        </div>
        <div class="header-inner">
            <div class="container">
                <div class="row">
                    <div class="header-logo col-xs-4">
                        <a href="/">Parus <span class="logo-text-colored">Tech</span> <span class="logo-text-small text-muted">demo site</span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom">
            <?php
                NavBar::begin([
                    'options' => [
                        'class' => 'navbar-inverse main-navbar',
                    ],
                ]);

                $navItems = [
                    ['label' => 'gallery', 'url' => ['/page/gallery']],
                    ['label' => 'contact', 'url' => ['/page/contact']]
                ];

                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav'],
                    'items' => array_merge(get_nav_by('alias', 'main_menu'), $navItems),
                ]);
                NavBar::end();
            ?>
        </div>
    </header>
    
    <div class="content-area container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Parus CMS <?= date('Y') ?></p>

        <p class="pull-right">
            <?= Yii::t('yii', 'Powered by') ?> <a target="_blank" href="https://github.com/rokorolov/parus-basic-app">Parus CMS</a>
        </p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
