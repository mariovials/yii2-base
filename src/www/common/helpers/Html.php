<?php
namespace common\helpers;
/**
 * Html
 */
class Html extends \yii\helpers\Html
{
  public static function activeCheckbox($model, $attribute, $options = [])
  {
    return static::activeBooleanInput('checkbox', $model, $attribute, $options);
  }

  protected static function activeBooleanInput($type, $model, $attribute, $options = [])
  {
    $name = isset($options['name']) ? $options['name'] : static::getInputName($model, $attribute);
    $value = static::getAttributeValue($model, $attribute);

    if (!array_key_exists('value', $options)) {
      $options['value'] = '1';
    }
    if (!array_key_exists('uncheck', $options)) {
      $options['uncheck'] = '0';
    } elseif ($options['uncheck'] === false) {
      unset($options['uncheck']);
    }
    if (!array_key_exists('label', $options)) {
      $options['label'] = static::encode($model->getAttributeLabel(static::getAttributeName($attribute)));
    } elseif ($options['label'] === false) {
      unset($options['label']);
    }
    $options['label'] = '<div class="box"></div>'
      . '<div class="label">' . $options['label'] . '</div>';
    $checked = "$value" === "{$options['value']}";
    if (!array_key_exists('id', $options)) {
      $options['id'] = static::getInputId($model, $attribute);
    }
    return static::$type($name, $checked, $options);
  }


  public static function activeDatalist($model, $attribute, $items, $options = [])
  {
    if (!array_key_exists('id', $options)) {
      $options['id'] = static::getInputId($model, $attribute);
    }
    if (!array_key_exists('list', $options)) {
      $options['list'] = $options['id'] . '-list';
    }
    $input = static::input('text', static::getInputName($model, $attribute), $model->$attribute, $options);
    $datalist_options = '';
    foreach ($items as $value => $text) {
      $datalist_options .= Html::tag('option', null, ['value' => $text]);
    }
    // @todo hacer datalist no active
    return $input
      . '<datalist id="' . $options['list'] . '">'
      . $datalist_options
      . '</datalist>';
  }

}
