<?php
return [
    'id' => 'yiicrm',
    'basePath' => realpath(__DIR__ . '/../'),
    'components' => [
        'request' => [
            'cookieValidationKey' => 'secret',
        ],
    ],
];