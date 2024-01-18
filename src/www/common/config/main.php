<?php
return [
  'language' => 'es',
  'sourceLanguage' => 'es-CL',
  'timeZone' => 'America/Santiago',
  'aliases' => [
    '@bower' => '@vendor/bower-asset',
    '@npm'   => '@vendor/npm-asset',
  ],
  'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
  'components' => yii\helpers\ArrayHelper::merge([
    'mailer' => [
      'class' => \yii\symfonymailer\Mailer::class,
        'viewPath' => '@common/mail',
        'useFileTransport' => false,
        'transport' => [
          'scheme' => 'smtp',
          'host' => 'smtp.gmail.com',
          'username' => 'laboratorio@molecvet.cl',
          'password' => 'eogbrktlsxcvbycf',
          'port' => '587',
          // 'dsn' => 'native://default',
      ],
    ],
    'i18n' => [
      'translations' => [
        'app' => [
          'class' => 'yii\i18n\PhpMessageSource',
          'basePath' => '@common/messages',
        ],
      ],
    ],
    'cache' => \yii\caching\FileCache::class,
    'formatter' => [
      'class' => 'common\components\Formatter',
      'timeZone' => 'America/Santiago',
      'defaultTimeZone' => 'America/Santiago',
      'dateFormat' => 'dd/MM/yyyy',
      'datetimeFormat' => 'dd/MM/yyyy HH:mm:ss',
      'decimalSeparator' => ',',
      'thousandSeparator' => '.',
      'currencyCode' => 'CLP',
    ],
  ],
  require __DIR__ . '/urlsManager.php',
)];
