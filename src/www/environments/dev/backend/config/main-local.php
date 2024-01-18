<?php

$config = [
  'components' => [
    'request' => [
      // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
      'cookieValidationKey' => 'gFpvCwmTDAiSQ-Vio8lrfLIvMskzz4Ae',
    ],
  ],
];

if (YII_DEBUG) {
  $config = yii\helpers\ArrayHelper::merge($config, [
    'bootstrap' => ['debug'],
    'modules' => [
      'debug' => [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['192.168.56.1', '::1'],
        'enableDebugLogs' => true
      ],
    ],
  ]);
}

if (YII_ENV == 'dev') {
  $config = yii\helpers\ArrayHelper::merge($config, [
    'bootstrap' => ['gii'],
    'modules' => [
      'gii' => [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['192.168.56.1', '::1'],
        'generators' => [
          'crud' => [
            'class' => '\backend\gii\crud\Generator',
            'templates' => [
              'default' => '@yii/gii/crud/default',
              'base' => '@app/gii/crud/base',
            ],
          ],
          'model' => [
            'class' => 'backend\gii\model\Generator',
            'templates' => [
              'default' => '@app/gii/model/default',
            ],
          ],
        ],
      ],
    ],
  ]);
}

return $config;
