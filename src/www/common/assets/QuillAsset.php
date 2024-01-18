<?php
namespace common\assets;

use yii\web\AssetBundle;

class QuillAsset extends AssetBundle
{
  public $sourcePath = '@npm/quill/dist';
  public $baseUrl = '@web';
  public $css = [
    'quill.snow.css'
  ];
  public $js = [
    'quill.min.js'
  ];
  public $depends = [
  ];
}
