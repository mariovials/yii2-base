<?php

namespace backend\widgets\breadcrumb;

use Yii;
use common\helpers\Html;
use yii\helpers\Url;

final class Breadcrumb extends \yii\base\Widget
{
  public $links = [];
  public $separator = '<span class="mdi mdi-chevron-right"></span>';

  public function init() {
    BreadcrumbAsset::register($this->view);
    parent::init();
  }

  function run() {
    $from = Yii::$app->request->get('from');
    $index = count($this->links) - 1;
    while($index > -1) {
      if (is_array($this->links[$index])
        && str_starts_with($from, Url::to($this->links[$index]['url']))) {
        $this->links[$index]['url'] = $from;
        break;
      }
      $index--;
    }
    $links = [];
    foreach($this->links as $link) {
      if (is_array($link)) {
        $links[] = '<li>' . Html::a($link['label'], $link['url']) . '</li>';
      } else {
        $links[] = '<li>' . $link . '</li>';
      }
    }
    echo '<ul class="breadcrumb">'
      . implode($this->separator, $links)
    . '</ul>';
  }
}
