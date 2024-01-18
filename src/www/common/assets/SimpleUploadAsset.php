<?php
namespace common\assets;

use yii\web\AssetBundle;

/**
 * Materialize Stepper Asset
 */
class SimpleUploadAsset extends AssetBundle
{
  public $sourcePath = '@npm/jquery-simple-upload';
  public $baseUrl = '@web';
  public $css = [];
  public $js = [
    'simpleUpload.min.js',
  ];
  public $depends = [
    'yii\web\JqueryAsset',
  ];
}
