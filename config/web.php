<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language'=>'en', 
    'components' => [
        'authClientCollection' => [
              'class' => 'yii\authclient\Collection',
              'clients' => [
                  'google' => [
                      'class' => 'yii\authclient\clients\GoogleOpenId'
                  ],
                  'twitter' => [
                                  'class' => 'yii\authclient\clients\Twitter',
                                  'consumerKey' => 'twitter_consumer_key',
                                  'consumerSecret' => 'twitter_consumer_secret',
                              ],
                ],
        ],
         'urlManager' => [
          'showScriptName' => false,
          'enablePrettyUrl' => true,
                 'rules' => [
              'status' => 'status/index',
              'status/index' => 'status/index',
              'status/create' => 'status/create',
              'status/view/<id:\d+>' => 'status/view',  
              'status/update/<id:\d+>' => 'status/update',  
              'status/delete/<id:\d+>' => 'status/delete',  
              'status/<slug>' => 'status/slug',
                    'defaultRoute' => '/site/index',
          ],   
                  ], 
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '5w-zKf0n3tZ6_zFbLGQ28Q7ch1i9i3gu',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
                'class' => 'yii\swiftmailer\Mailer',
        'viewPath' => '@app/mailer',
        'useFileTransport' => false,
        'transport' => [
            'class' => 'Swift_SmtpTransport',
            'host' => 'smtp.gmail.com',
            'username' => 'gabriela.mcr1993@gmail.com',
            'password' => 'gabriela93',
            'port' => '587',
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
        'db' => require(__DIR__ . '/db.php'),
    ],
    'modules' => [
    'user' => [
        'class' => 'dektrium\user\Module',
                'enableUnconfirmedLogin' => true,
        'confirmWithin' => 21600,
        'cost' => 12,
        'admins' => ['gaby123']
    ],
        'redactor' => 'yii\redactor\RedactorModule',
        'class' => 'yii\redactor\RedactorModule',
          'uploadDir' => '@webroot/uploads',
          'uploadUrl' => '/hello/uploads',
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
