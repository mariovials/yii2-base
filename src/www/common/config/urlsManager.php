<?php
/**
 * FRONTEND_HOST http://molecvet.local
 * BACKEND_HOST  http://admin.molecvet.local
 * /src/www/common/config/bootstrap-local.php
 */

$urlsManager = [
  'frontend' => [
    'class' => 'yii\web\UrlManager',
    'hostInfo' => FRONTEND_HOST,
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
      '<controller>/<id:\d+>' => '<controller>/ver',
      '<controller>/<id:\d+>/<action>' => '<controller>/<action>',
      '<controller>' => '<controller>/lista',
    ],
  ],
  'backend' => [
    'class' => 'yii\web\UrlManager',
    'hostInfo' => BACKEND_HOST,
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
      '<controller>/<id:\d+>' => '<controller>/ver',
      '<controller>/<id:\d+>/<action>' => '<controller>/<action>',
      '<controller>' => '<controller>/lista',
    ],
  ],
];
$componentsUrlsManager = [];
foreach ($urlsManager as $id => $urlManager) {
  $componentsUrlsManager['urlManager' . ucfirst($id)] = $urlManager;
  if (ID_APPLICATION == $id) {
    $componentsUrlsManager['urlManager'] = $urlManager;
  }
}
return $componentsUrlsManager;
