<?php
/**
 * FRONTEND_HOST http://molecvet.local
 * BACKEND_HOST  http://admin.molecvet.local
 * /src/www/common/config/bootstrap-local.php
 */

$commonRules = [
];
$urlsManager = [
  'frontend' => [
    'class' => 'yii\web\UrlManager',
    'hostInfo' => FRONTEND_HOST,
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => array_merge([
      '<controller>/<id:\d+>' => '<controller>/ver',
      '<controller>/<id:\d+>/<action>' => '<controller>/<action>',
      '<controller>' => '<controller>/lista',
    ], $commonRules),
  ],
  'backend' => [
    'class' => 'yii\web\UrlManager',
    'hostInfo' => BACKEND_HOST,
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
      '<controller:(publicacion|autor|editor|editorial)>es' => '<controller>/lista',
      '<controller:(idioma|usuario)>s' => '<controller>/lista',
      '<controller>' => '<controller>/lista',

      '<controller>/<action:agregar>' => '<controller>/<action>',
      '<controller:(persona|editorial|idioma)>/<action:buscar>' => '<controller>/buscar',
      '<controller:(publicacion|autor|editor|editorial|idioma)>/<slug>' => '<controller>/ver',


      '<controller>/<id:\d+>/<action>' => '<controller>/<action>',
      '<controller>/<id:\d+>' => '<controller>/ver',
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
