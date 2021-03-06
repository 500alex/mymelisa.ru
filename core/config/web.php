<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'sjgRZzkekHfhwPtGxmnnJe7LmQT7o2vQ',
		        //'cookieValidationKey' => '',
		        'enableCsrfValidation' => false,
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
		        'useFileTransport' => false,
		        'viewPath' => '@app/mail',
		        'transport' => [
			        'class' => 'Swift_SmtpTransport',
			        'host' => 'smtp.mail.ru',
			        'username' => 'dance@my-wins.ru',
			        'password' => 'SakurA1290',
			        'port' => '465',
			        'encryption' => 'ssl',
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'pattern'          => '<action:\w+>',
                    'route'            => 'site/<action>',
                    'defaults'          => ['action' => 'index'],
                ]
            ],
        ],
				'view' => [
					'theme' => [
						'pathMap' => [
							'@app/views' => '@app/themes/dance/views',
							'@app/modules' => '@app/themes/dance/modules'
						],
					],
				],
		    'assetManager' => [
			    'converter' => [
				    'class' => 'yii\web\AssetConverter',
				    'commands' => [
					    'less' => false,
				    ],
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
        'allowedIPs' => ['*.*.*.*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['*.*.*.*'],
    ];
}

return $config;
