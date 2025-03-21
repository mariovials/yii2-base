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
  public $linkTemplate = '<a href="{url}">{label}</a>';
  public $activeCssClass = 'activo';
  public $submenuTemplate = "\n<ul>\n{items}\n</ul>\n";

  private $route;
  private $params;

  public function run() {
    $this->route = Yii::$app->controller->getRoute();
    $this->params = Yii::$app->request->getQueryParams();
    $items = $this->normalizeItems($this->items, $hasActiveChild);
    if (!empty($items)) {
      echo Html::tag('ul', $this->renderItems($items));
    }
  }

  protected function normalizeItems($items, &$active)
  {
    foreach ($items as $i => $item) {
      if (isset($item['visible']) && !$item['visible']) {
        unset($items[$i]);
        continue;
      }
      if (!isset($item['label'])) {
        $item['label'] = '';
      }
      $hasActiveChild = false;
      if (isset($item['items'])) {
        $items[$i]['items'] = $this->normalizeItems($item['items'], $hasActiveChild);
        if (empty($items[$i]['items'])) {
          unset($items[$i]['items']);
          if (!isset($item['url'])) {
            unset($items[$i]);
            continue;
          }
        }
      }
      if (!isset($item['active'])) {
        if (true && $hasActiveChild || true && $this->isItemActive($item)) {
          $active = $items[$i]['active'] = true;
        } else {
          $items[$i]['active'] = false;
        }
      } elseif ($item['active'] instanceof Closure) {
        $active = $items[$i]['active'] = call_user_func($item['active'], $item, $hasActiveChild, $this->isItemActive($item), $this);
      } elseif ($item['active']) {
        $active = true;
      }
    }

    return array_values($items);
  }

  protected function renderItems($items)
  {
      $n = count($items);
      $lines = [];
      foreach ($items as $i => $item) {
          $tag = 'li';
          $class = [];
          if ($item['active']) {
              $class[] = $this->activeCssClass;
          }
          Html::addCssClass($options, $class);

          $menu = $this->renderItem($item);
          if (!empty($item['items'])) {
              $submenuTemplate = ArrayHelper::getValue($item, 'submenuTemplate', $this->submenuTemplate);
              $menu .= strtr($submenuTemplate, [
                  '{items}' => $this->renderItems($item['items']),
              ]);
          }
          $lines[] = Html::tag($tag, $menu, $options);
      }

      return implode("\n", $lines);
  }

  protected function renderItem($item)
  {
      if (isset($item['url'])) {
          $template = ArrayHelper::getValue($item, 'template', $this->linkTemplate);

          return strtr($template, [
              '{url}' => Html::encode(Url::to($item['url'])),
              '{label}' => $item['label'],
          ]);
      }

      $template = ArrayHelper::getValue($item, 'template', $this->labelTemplate);

      return strtr($template, [
          '{label}' => $item['label'],
      ]);
  }


  protected function isItemActive($item)
  {
    if (isset($item['url']) && is_array($item['url']) && isset($item['url'][0])) {
      $route = Yii::getAlias($item['url'][0]);
      if (strncmp($route, '/', 1) !== 0 && Yii::$app->controller) {
        $route = Yii::$app->controller->module->getUniqueId() . '/' . $route;
      }
      if (ltrim($route, '/') !== $this->route) {
        return false;
      }
      unset($item['url']['#']);
      if (count($item['url']) > 1) {
        $params = $item['url'];
        unset($params[0]);
        foreach ($params as $name => $value) {
          if ($value !== null && (!isset($this->params[$name]) || $this->params[$name] != $value)) {
            return false;
          }
        }
      }
      return true;
    }

    return false;
  }
}
