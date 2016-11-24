<?php

return array_merge(
    [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;dbname=yii2basic',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
    ],
    is_file(__DIR__ . DIRECTORY_SEPARATOR . 'db-local.php') ? include_once __DIR__ . DIRECTORY_SEPARATOR . 'db-local.php' : []
);
