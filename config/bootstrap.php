<?php

require(__DIR__ . '/../vendor/rokorolov/parus/src/admin/api/api.php');
require(__DIR__ . '/../vendor/rokorolov/parus/src/admin/api/api_presenter.php');
require(__DIR__ . '/../vendor/rokorolov/parus/src/admin/api/api_cache.php');

set_post_presenter('app\presenters\PostPresenter');
set_photo_presenter('app\presenters\PhotoPresenter');
set_category_presenter('app\presenters\CategoryPresenter');
