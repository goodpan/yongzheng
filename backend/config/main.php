<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'defaultRoute'=>'console/overview/index',
    'bootstrap' => ['log'],
    'modules' => [
        'collection'=>['class'=>'backend\modules\collection\Collection'],//采集模块
        'info'=>['class'=>'backend\modules\info\Info'],//信息模块
        'marketing'=>['class'=>'backend\modules\marketing\Marketing'],//营销模块
        'manager'=>['class'=>'backend\modules\manager\Manager'],//管理员模块
        'system'=>['class'=>'backend\modules\system\System'],//系统模块
        'console'=>['class'=>'backend\modules\console\Console'],//系统模块
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User', // User must implement the IdentityInterface
            'enableAutoLogin' => true,
            // 'loginUrl' => ['user/login'],
            // ...
        ],
        // 'user' => [
        //     'identityClass' => 'common\models\User',
        //     'enableAutoLogin' => true,
        //     'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        // ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'yongzheng_backend',
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
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params
];
