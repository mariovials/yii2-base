<?php

namespace common\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class MaterialFormAsset extends AssetBundle
{
  public $publishOptions = [
    'forceCopy' => YII_ENV === 'dev',
  ];
  public $sourcePath = '@common/web';
  public $js = [
    'js/form.js?v=9',
  ];
}
