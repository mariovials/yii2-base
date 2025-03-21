<?php

namespace backend\widgets;

use Closure;
use common\helpers\ArrayHelper;
use common\helpers\Html;
use Yii;
use yii\base\Widget;
use yii\helpers\Url;

final class Menu extends Widget
{
  public $items = [];
  public $anidado = true;
  public $submenu;

  private $route;
  // private $params;

  public function run()
  {
    $this->route = Yii::$app->controller->getRoute();

    $items = $this->normalizarItems($this->items, $activo);
    echo Html::tag('ul', $this->renderItems($items));
    if ($this->submenu) {
      echo Html::tag('ul', $this->renderItems($this->submenu));
    }
  }

  protected function normalizarItems($items, &$activo)
  {
    foreach($items as $i => $item) {
      if ($item == ['divider']) {
        continue;
      }
      if (isset($item['visible']) && !$item['visible']) {
        unset($items[$i]);
        continue;
      }
      if (!isset($item['badge'])) {
        $items[$i]['badge'] = false;
      }
      $tieneItemActivo = false;
      if (isset($item['items'])) {
        $items[$i]['items'] = $this->normalizarItems($item['items'], $tieneItemActivo);
      }
      if (!isset($item['activo'])) {
        if ($tieneItemActivo || $this->esActivo($item)) {
          $activo = $items[$i]['activo'] = true;
        } else {
          $items[$i]['activo'] = false;
        }
      } elseif ($item['activo']) {
        $activo = true;
      }
    }
    return array_values($items);
  }

  protected function renderItems($items)
  {
    $lines = [];
    foreach($items as $item) {
      if ($item == ['divider']) {
        $lines[] = Html::tag('li', '', ['class' => 'divider']);
      } else {
        $a = $this->renderItem($item);
        if (isset($item['items'])) {
          if ($item['activo']) {
            if ($this->anidado) {
              $a .= Html::tag('ul', $this->renderItems($item['items']));
            } else {
              $this->submenu = $item['items'];
            }
          }
        }
        $lines[] = Html::tag('li', $a, ['class' => $item['activo'] ? 'activo' : '']);
      }
    }
    return implode("\n", $lines);
  }

  protected function renderItem($item)
  {
    $mdi = Html::tag('span', '', ['class' => 'mdi mdi-' . $item['icon']]);
    $label = Html::tag('span', $item['label']);
    $badge = $item['badge'] ? Html::tag('span', $item['badge'], ['class' => 'badge']) : '';
    $url = Url::to($item['url']);
    return Html::a($mdi . $label . $badge, $url);
  }

  protected function esActivo($item)
  {
    $url = explode('/', trim($item['url'][0], '/'));
    if (count($url) == 1) {
      return $url[0] == Yii::$app->controller->id;
    } else {
      $route = Yii::getAlias($item['url'][0]);
      if (strncmp($route, '/', 1) !== 0 && Yii::$app->controller) {
        $route = Yii::$app->controller->module->getUniqueId() . '/' . $route;
      }
      if (ltrim($route, '/') !== $this->route) {
        return false;
      }
    }
    // unset($item['url']['#']);
    // if (count($item['url']) > 1) {
    //   $params = $item['url'];
    //   unset($params[0]);
    //   foreach ($params as $name => $value) {
    //     if ($value !== null && (!isset($this->params[$name]) || $this->params[$name] != $value)) {
    //       return false;
    //     }
    //   }
    // }
    return true;
  }
}
