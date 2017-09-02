<?php

$params = require(__DIR__ . '/params.php');
$db     = require(__DIR__ . '/db.php');

$config = [
    'id'             => 'basic',
    'language'       => 'ru-RU',
    'sourceLanguage' => 'en-US',
    'basePath'       => dirname(__DIR__),
    'bootstrap'      => ['log'],
    'modules'        => [
        'user'     => [
            'class'           => 'dektrium\user\Module',
            'adminPermission' => $params['roles']['admin'],
            'modelMap'        => [
                'Profile' => '\app\models\Profile',
                'User'    => '\app\models\User',
            ]
        ],
        'rbac'     => 'dektrium\rbac\RbacWebModule',
        'gridview' => ['class' => 'kartik\grid\Module'],
    ],
    'components'     => [
        'request'      => [
            'cookieValidationKey' => '7am9Y--WBXhcaLLyjQLa2d64zp4yW2rj',
        ],
        'assetManager' => [
            'forceCopy' => true,
        ],
        'i18n'         => [
            'translations' => [
                'app*' => [
                    'class'    => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    'fileMap'  => [
                        'app' => 'app.php',
                    ],
                ],
            ],
        ],
        'cache'        => [
            'class' => 'yii\caching\FileCache',
        ],
        'user'         => [
            'identityClass'   => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer'       => [
            'class'            => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
        ],
        'mailSender'   => [
            'class' => 'app\components\MailSender',
        ],
        'log'          => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db'           => $db,
        'urlManager'   => [
            'class'           => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
            'rules'           => [
                '/' => 'product/index',

                '<controller:\w+>'                       => '<controller>/index',
                '<controller:\w+>/<action:\w+>'          => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
            ],
        ],
        'view'         => [
            'theme' => [
                'pathMap' => [
                    '@dektrium/user/views/settings' => '@app/views/dektrium/settings'
                ],
            ],
        ],
    ],
    'params'         => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][]      = 'debug';
    $config['modules']['debug'] = [
        'class'      => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][]    = 'gii';
    $config['modules']['gii'] = [
        'class'      => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
