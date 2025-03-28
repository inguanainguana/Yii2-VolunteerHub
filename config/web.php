<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
    ],
    'language' => 'ru-RU',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'gdfgfgfdgfdgfgf',
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
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            'transport' => [
                'scheme' => 'smtp',
                'host' => 'smtp.mail.ru',
                'username' => 'inga.komogorova.6_9@mail.ru',
                'password' => 's4kPWeumDGWPQKeQm5sX',
                'port' => '465',
                'encryption' => 'tls',
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
                'login' => 'site/login',
                'register' => 'site/register',
                'create_event' => 'event/create',
                'update/<id:\d+>' => 'event/update',
                'view_event/<id:\d+>' => 'event/view',
                'list_events' => 'event/index',
                'your_events' => 'event/your-events',
                'apply/<id:\d+>' => 'event-registrations/apply',
                'report' => 'admin/report/index',
                'admin' => 'admin/default/index',
                'admin_event' => 'admin/event/index',
                'admin_create_event' => 'admin/event/create',
                'admin_update/<id:\d+>' => 'admin/event/update',
                'admin_view_event/<id:\d+>' => 'admin/event/view',
                'admin_event-registrations' => 'admin/event-registrations/index',
                'admin_create_event_registrations' => 'admin/event-registrations/create',
                'admin_event_registrations_update/<id:\d+>' => 'admin/event-registrations/update',
                'admin_view_event_registrations/<id:\d+>' => 'admin/event-registrations/view',
                'profile' => 'site/profile',
                'profile/<id:\d+>' => 'site/profile',
                'activity' => 'activity/index',
                'admin_reviews' => 'admin/reviews/index',
                'admin_reviews/<id:\d+>' => 'admin/reviews/view',
                'admin_reviews_update/<id:\d+>' => 'admin/reviews/update',
            ],
        ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
