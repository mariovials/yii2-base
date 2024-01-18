<?php
namespace common\assets;

use yii\web\AssetBundle;

/**
 * MomentAsset
 */
class MomentAsset extends AssetBundle
{
  public $sourcePath = '@npm/moment/min';
  public $baseUrl = '@web';
  public $js = [
    'moment.min.js',
  ];
}
