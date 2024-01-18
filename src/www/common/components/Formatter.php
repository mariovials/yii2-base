<?php

namespace common\components;

use IntlDateFormatter;

/**
 * Formatter
 * @author Mario Vial <mvial@ubiobio.cl> 2023/07/18 11:28
 */
class Formatter extends \yii\i18n\Formatter
{
  private $datetimeFormats = [
    'normal' => "d MMMM yyyy, HH:mm 'hrs.'",
    'corta' => "d/MM/yy HH:mm 'hrs.'",
    'larga' => "eeee, d 'de' MMMM 'de' yyyy 'a las' HH:mm 'hrs.'",
  ];
  public function asDatetime($value, $format = 'normal') {
    if (isset($this->datetimeFormats[$format])) {
      $timestamp = $this->normalizeDatetimeValue($value);
      $format = $this->datetimeFormats[$format];
      $formatter = new IntlDateFormatter(
        $this->locale,
        null,
        null,
        $this->timeZone,
        $this->calendar,
        $format
      );
      return $formatter->format($timestamp);
    }
    return parent::asDatetime($value, $format);
  }
  private $dateFormats = [
    'normal' => "d MMMM yyyy",
    'corta' => "d/MM/yy",
    'larga' => "eeee, d 'de' MMMM 'de' yyyy 'a las' HH:mm 'hrs.'",
  ];
  public function asDate($value, $format = 'normal') {
    if (isset($this->dateFormats[$format])) {
      $timestamp = $this->normalizeDatetimeValue($value);
      $format = $this->dateFormats[$format];
      $formatter = new IntlDateFormatter(
        $this->locale,
        null,
        null,
        $this->timeZone,
        $this->calendar,
        $format
      );
      return $formatter->format($timestamp);
    }
    return parent::asDate($value, $format);
  }
}
