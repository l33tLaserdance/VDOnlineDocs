<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
	'language' => 'ru-RU',
	'timeZone' => 'Europe/Moscow',
	'name' => 'VDTECH Online Docs by Evgeniy Kiselevskiy',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'debug'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
				'/' => 'site/index',
				'signup' => 'site/signup',
				'login' => 'site/login',
				'organization' => 'organization/index',
				'organization/objects' => 'objects/index',
				'organization/objects/cases' => 'cases/index'
            ],
        ],
		
		'assetManager' => [
             'basePath' => '@webroot/assets',
             'baseUrl' => '@web/assets'
        ],  
        'request' => [
            'baseUrl' => ''
        ]
        
    ],
	'modules' => [
		'gridview' => ['class' => 'kartik\grid\Module'],
		'debug' => [
            'class' => 'yii\debug\Module',
            'allowedIPs' => ['10.201.1.99']
        ]
	],
    'params' => $params,
];
