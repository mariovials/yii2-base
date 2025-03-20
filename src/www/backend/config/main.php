<?php
$params = array_merge(
  require __DIR__ . '/../../common/config/params.php',
  require __DIR__ . '/../../common/config/params-local.php',
  require __DIR__ . '/params.php',
  require __DIR__ . '/params-local.php'
);

return [
  'id' => 'backend',
  'basePath' => dirname(__DIR__),
  'controllerNamespace' => 'backend\controllers',
  'bootstrap' => ['log'],
  'modules' => [],
  'defaultRoute' => 'sistema/lista',
  'components' => [
    'view' => [
      'class' => 'backend\components\View',
      'theme' => [
        'basePath' => '@backend/themes/material',
        'pathMap' => [
          '@backend/views' => [
            '@backend/themes/material',
            '@app/views',
          ],
        ],
      ],
    ],
    'assetManager' => [
      'linkAssets' => true,
    ],
    'request' => [
      'csrfParam' => '_csrf',
    ],
    'user' => [
      'identityClass' => 'common\models\Usuario',
      'loginUrl' => ['sistema/ingresar'],
      'enableAutoLogin' => true,
      'identityCookie' => ['name' => '_identity', 'httpOnly' => true],
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
