<?php
$params = array_merge(
  require __DIR__ . '/../../common/config/params.php',
  require __DIR__ . '/../../common/config/params-local.php',
  require __DIR__ . '/params.php',
  require __DIR__ . '/params-local.php'
);

return [
  'id' => 'app-frontend',
  'basePath' => dirname(__DIR__),
  'bootstrap' => ['log'],
  'controllerNamespace' => 'frontend\controllers',
  'defaultRoute' => 'sistema/portada',
  'components' => [
    'view' => [
      'theme' => [
        'basePath' => '@frontend/themes/material',
        'pathMap' => [
          '@frontend/views' => [
            '@frontend/themes/material',
            '@frontend/views',
          ],
        ],
      ],
    ],
    'request' => [
      'csrfParam' => '_csrf',
    ],
    'user' => [
      'class' => 'frontend\components\User',
      'identityClass' => 'common\models\Usuario',
      'enableAutoLogin' => true,
      'identityCookie' => ['name' => '_identity', 'httpOnly' => true],
      'loginUrl' => 'sistema/ingresar',
    ],
    'session' => [
      'class' => yii\web\DbSession::class,
      'name' => 'advanced',
      'useStrictMode' => true,
      'timeout' => 10,
    ],
    'log' => [
      'traceLevel' => YII_DEBUG ? 3 : 0,
      'targets' => [
        [
          'class' => \yii\log\FileTarget::class,
          'levels' => ['error', 'warning'],
        ],
      ],
    ],
    'errorHandler' => [
      'errorAction' => 'sistema/error',
    ],
  ],
  'params' => $params,
];
