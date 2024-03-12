<?php
namespace common\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class Select2Asset extends AssetBundle
{
  public $sourcePath = '@npm/select2/dist';
  public $baseUrl = '@web';
  public $css = [
    'css/select2.min.css'
  ];
  public $js = [
    'js/select2.min.js',
    // 'js/i18n/es.js',
  ];
  public $depends = [
    'yii\web\JqueryAsset',
  ];
}
