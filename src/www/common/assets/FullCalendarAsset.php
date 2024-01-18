<?php
namespace common\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class FullCalendarAsset extends AssetBundle
{
  public $sourcePath = '@npm';
  public $baseUrl = '@web';
  public $css = [
    // 'fullcalendar.css',
  ];
  public $js = [
    'fullcalendar/index.global.min.js',
  ];
  public $depends = [
    'yii\web\JqueryAsset',
    // 'backend\assets\MomentAsset',
  ];
}
