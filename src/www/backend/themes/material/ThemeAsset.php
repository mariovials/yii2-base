<?php

namespace backend\themes\material;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class ThemeAsset extends AssetBundle
{
  public $sourcePath = '@backend/themes/material';

  public $css = [
    'css/style.css?v=1',
  ];

  public $js = [
    'js/main.js?v=1',
  ];

  public $depends = [
    'common\assets\MdiAsset',
  ];

}
