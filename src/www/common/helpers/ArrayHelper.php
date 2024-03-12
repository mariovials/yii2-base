<?php
namespace common\helpers;
/**
 * Html
 */
class ArrayHelper extends \yii\helpers\ArrayHelper
{
  /**
   * Separa con ", " y pone una " y " antes del último elemento
   * @author Mario Vial <mvial@ubiobio.cl> 01/06/2021 15:14
   */
  public static function y($words, $separador = ', ', $final = ' y ')
  {
    if (!is_array($words)) {
      return $words;
    }
    $words =  array_filter($words, function($s) {
      return !is_null($s) && trim($s) !== '';
    });
    $words = array_map('trim', $words);
    switch (count($words)) {
      case 0:
        return '';
      case 1:
        return reset($words);
      case 2:
        if (str_starts_with(mb_strtolower(strip_tags(end($words))), 'i'))
          $final = ' e ';
        return implode($final, $words);
      default:
        if (str_starts_with(mb_strtolower(strip_tags(end($words))), 'i'))
          $final = ' e ';
        return implode($separador, array_slice($words, 0, -1)) . $final . end($words);
    }
  }
}
