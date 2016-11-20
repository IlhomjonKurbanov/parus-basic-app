<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        'admin' => [
            'class' => 'rokorolov\parus\admin\Module',
            'config' => [
                'additionalComponents' => [
                    'formatter' => [
                        'class' => 'yii\i18n\Formatter',
                        'defaultTimeZone' => 'Europe/Riga',
                        'timeZone' => 'Europe/Riga',
                        'dateFormat' => 'php:d-m-Y',
                        'datetimeFormat' => 'php:d-m-Y H:i:s',
                        'timeFormat' => 'php:H:i:s'
                    ],
                ],
            ],
            'blogConfig' => [
                'post.introImageConfig' => [
                    'transformations' => [
                        ['postfix' => 'thumb', 'width' => 74, 'height' => 55, 'method' => 'crop'],
                        ['postfix' => 'small', 'width' => 300, 'height' => 168, 'method' => 'crop'],
                        ['postfix' => 'large', 'width' => 770]
                    ]
                ]
            ],
            'galleryConfig' => [
                'uploadImageConfig' => [
                    'imageTransformations' => [
                        ['width' => 230, 'height' => 170, 'method' => 'crop', 'postfix' => 'thumb'],
                    ]
                ],
                'uploadImageMapConfig' => [
                    '1' => [
                        'minImageWidth' => 1200,
                        'minImageHeight' => 470,
                        'imageTransformations' => [
                            ['postfix' => 'large', 'width' => 1200, 'height' => 470, 'method' => 'crop'],
                        ]
                    ],
                ]
            ],
            'fileManagerConfig' => [
                'responsiveFileManagerSrc' => '/plugins/responsivefilemanager/dialog.php?type=0',
                'privateKey' => 'ioqopwdklm'
            ]
        ]
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'nEsyPAtFSu5JVgXmicCaAEUgp-BnoS-3',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    'categories' => ['logic'],
                    'logFile' => '@runtime/logs/logic.log',
                ],
            ],
        ],
        'db' => array_merge(
			include_once __DIR__ . '/db.php',
			is_file(__DIR__ . '/db-local.php') ? include_once __DIR__ . '/db-local.php' : []
		),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'page/index',
                '<action:(about|contact|gallery)>' => 'page/<action>',
                'admin' => 'admin/dashboard/dashboard/index',
                [
                    'class' => 'rokorolov\parus\menu\components\PageUrlRule',
                ],
                [
                    'class' => 'rokorolov\parus\menu\components\CategoryUrlRule',
                ],
                [
                    'class' => 'rokorolov\parus\menu\components\PostUrlRule',
                ]
            ],
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'defaultTimeZone' => 'Europe/Riga',
            'timeZone' => 'Europe/Riga',
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
