<?php
return [
    'id' => 'yiicrm',
    'basePath' => realpath(__DIR__ . '/../'),
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            // 'defaultRoles' => ['guest'],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'request' => [
            'cookieValidationKey' => 'secret',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false
        ],
        'view' => [
            'renderers' => [
                'md' => [
                    'class' => 'app\utilities\MarkdownRenderer'
                ],
            ],
        ],
        'response' => [
            'formatters' => [
                'yaml' => [
                    'class' => 'app\utilities\YamlResponseFormatter'
                ],
            ],
        ],
        'user' => [
            'identityClass' => 'app\models\user\UserRecord'
        ]
    ],
    'modules' => [
        'gii' => [
            'class' => 'yii\gii\Module',
            'allowedIPs' => ['*']
        ]
    ],
    'extensions' => require(__DIR__ . '/../vendor/yiisoft/extensions.php')
];