<?php
return [
    'id' => 'yiicrm',
    'basePath' => realpath(__DIR__ . '/../'),
    'components' => [
        'db' => require(__DIR__ . '/db.php'),
        'request' => [
            'cookieValidationKey' => 'secret',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false
        ],
    ],
    'modules' => [
        'gii' => [
            'class' => 'yii\gii\Module',
            'allowedIPs' => ['*']
        ]
    ],
    'extensions' => require(__DIR__ . '/../vendor/yiisoft/extensions.php')
];