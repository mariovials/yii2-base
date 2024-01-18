<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
  public $basePath = '@webroot';
  public $baseUrl = '@web';
  public $css = [
    'css/styles.css?v=2',
  ];
  public $js = [
    'js/main.js?v=2',
  ];
  public $depends = [
    'yii\web\YiiAsset',
    'common\assets\MdiAsset',
  ];
}
