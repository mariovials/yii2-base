<?php

namespace backend\widgets\breadcrumb;

use Yii;
use common\helpers\Html;
use yii\helpers\Url;

final class Breadcrumb extends \yii\base\Widget
{
  public $links = [];
  public $separator = '<span class="mdi mdi-chevron-right"></span>';

  public function init()
  {
    BreadcrumbAsset::register($this->view);
    parent::init();
  }

  function run()
  {
    $links = [];
    $from = Yii::$app->request->get('from');
    $index = count($this->links) - 1;
    while($index > -1) {
      if (is_array($this->links[$index])) {
        $url = Url::to($this->links[$index]['url']);
        if ($from) {
          if (str_starts_with($from, $url)) {
            $url = $from;
          }
          parse_str(parse_url($from, PHP_URL_QUERY), $result);
          $from = $result['from'] ?? $from;
        }
        $li = '<li>' . Html::a($this->links[$index]['label'], $url) . '</li>';
      } else {
        $li = '<li>' . $this->links[$index] . '</li>';
      }
      array_unshift($links, $li);
      $index--;
    }
    echo '<ul class="breadcrumb">' . implode($this->separator, $links) . '</ul>';
  }
}
