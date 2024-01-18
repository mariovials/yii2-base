<?php
namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class MdiAsset extends AssetBundle
{
  public $sourcePath = '@npm/mdi';
  public $baseUrl = '@web';
  public $css = [
    'css/materialdesignicons.min.css'
  ];
  public $js = [
  ];
  public $depends = [
  ];
}
