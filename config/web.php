<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '123456',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager'=>[
            'class'=>'yii\rbac\DbManager', 
            'itemTable' =>'{{%auth_item}}', //权限角色表
            'itemChildTable'=>'{{%auth_item_child}}',//角色与权限的关系，角色与角色的关系
            'assignmentTable'=>'{{%auth_assignment}}', //用户与角色的关系
            'ruleTable'=>'{{%auth_rule}}', //额外规则
            'defaultRoles' =>['default'], //默认角色
        ],
        
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'bis'=>[
            'class'=>'\yii\web\User',
            'identityClass'=>'\app\models\BisAccount',
            'idParam'=>'__bis',
            'identityCookie'=>['name'=>'__bis_identity','httpOnly'=>true],
            'enableAutoLogin'=>true,
            'loginUrl'=>'/bis/login/index',
        ],
        'admin'=>[
            'class'=>'\yii\web\User',
            'identityClass'=>'\app\Module\admin\models\Admin',
            'idParam'=>'__admin',
            'identityCookie'=>['name'=>'__admin_identity','httpOnly'=>true],
            'enableAutoLogin'=>true,
            'loginUrl'=>'/admin/admin/login',
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
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.163.com',
                'username' => '17739650739@163.com',
                'password' => '163com742253912',
                'port' => '25',
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
                
                /*[
                 'class' => 'yii\log\EmailTarget',  //发邮件时会阻塞页面
                 'mailer' => 'mailer',
                 'levels' => ['error', 'warning'],
                 'message' => [
                     'from' => ['17739650739@163.com'],
                     'to' => ['742253912@qq.com', '7422....2@qq.com'],
                     'subject' => 'Log message',
                    ],
                ],*/
                 [
                    'class' => 'mito\sentry\Target',
                    'levels' => ['error', 'warning'],
                    'except' => [
                        'yii\web\HttpException:404',
                    ],
                ],
            ],
        ],
        
        
        'db' => require(__DIR__ . '/db.php'),
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                
            ],
        ],
        'sentry' => [
            'class' => 'mito\sentry\Component',
            'dsn' => 'https://0a87a5d26b6c48cdbf128602ae7b621a:06fa32b4dec94b1f8d24c5c1b5f5d414@sentry.io/161038', // private DSN
            'publicDsn'=>'https://0a87a5d26b6c48cdbf128602ae7b621a@sentry.io/161038',
            'environment' => 'staging', // if not set, the default is `production`
            'jsNotifier' => false, // to collect JS errors. Default value is `false`
            'jsOptions' => [ // raven-js config parameter
                'whitelistUrls' => [ // collect JS errors from these urls
                    
                ],
            ],
        ],
       'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => 'localhost',
            'port' => 6379,           
            'database' => 1,
        ],
        'session' => [
            'class' => 'yii\redis\Session',
            'redis' =>'redis'
        ],
        'car' =>[
            'class'=>'app\Module\index\controllers\car',

        ],
        
        
    ],
    'params' => $params,
    'defaultRoute'=>'index', //默认路由
        
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
    $config['modules']['admin'] = [
        'class'=>'app\Module\admin\index'
    ];
    $config['modules']['index'] = [
        'class'=>'app\Module\index\index'
    ];
    $config['modules']['bis'] = [
        'class'=>'app\Module\bis\index'
    ];
    $config['modules']['api'] = [
        'class'=>'app\Module\api\index'
    ];

}

return $config;
