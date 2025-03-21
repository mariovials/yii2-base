<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
  public $basePath = '@webroot';
  public $baseUrl = '@web';
  public $css = [
    'css/styles.css?v=1',
  ];
  public $js = [
    'js/main.js?v=1',
  ];
  public $depends = [
    'yii\web\YiiAsset',
    'common\assets\MdiAsset',
  ];
}
