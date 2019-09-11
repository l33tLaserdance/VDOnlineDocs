<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
	'language' => 'ru-RU',
	'timeZone' => 'Europe/Moscow',
	'name' => 'VDTECH Onlinedocs Admin Panel by Evgeniy Kiselevskiy',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'request' => [
			'cookieValidationKey' => 'FXZ40FNjDB4EjejwTmic',
            'csrfParam' => '_backendCSRF',
			'baseUrl' => '/admin',
        ],
        'user' => [
            'identityClass' => 'common\models\Admin',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_backendUser', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'PHPBACKSESSID',
            'savePath' => sys_get_temp_dir(),
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
			'baseUrl' => '/admin',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
				'/admin' => 'site/index',
				'<controller:\w+>/<action:\w+>/' => '<controller>/<action>',
            ],
        ],
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
