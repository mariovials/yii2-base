<?php
namespace console\components;

use common\helpers\ArrayHelper;

/**
 * Mi propia clase de consola
 * @author Mario Vial <mvial@ubiobio.cl> 10/12/2020 14:08
 */
class Console extends \yii\helpers\Console
{
  public static function enter($texto = '')
  {
    echo $texto ?? "Presione [enter] para continuar...";
    $h = fopen("php://stdin", "r");
    $r = trim(fgets($h));
    Console::moveCursorUp();
    Console::clearLine();
    fclose($h);
  }

  public static function echo($texto = '', $separador = "\n")
  {
    if (is_array($texto)) {
      foreach ($texto as $elemento) {
        self::dump($elemento, $separador);
      }
    } else {
      echo "{$texto}{$separador}";
    }
  }

  public static function br($texto = '')
  {
    echo "\n$texto\n";
  }

  public static function die($texto = '')
  {
    if ($texto) {
      echo "\n$texto\n";
    }
    die();
  }

  public static function dump($texto, $separador = "\n", $pre = '')
  {
    if (is_object($texto)) {
      $texto = ArrayHelper::toArray($texto);
    }
    if (is_array($texto)) {
      foreach ($texto as $i => $elemento) {
        echo "{$pre}{$i} => ";
        self::dump($elemento, $separador, "$pre  ");
        echo "$separador";
      }
    } else {
      echo "{$texto}";
    }
  }

  public static function attributes($arreglo)
  {
    if (is_object($arreglo)) {
      $arreglo = ArrayHelper::toArray($arreglo);
    }
    $maximo = max([3, max(array_map('mb_strlen', array_keys($arreglo)))]);
    foreach ($arreglo as $key => $value) {
      echo mb_str_pad($key, $maximo, ' ') . " => $value\n";
    }
  }

  public static function tabla($arr, $header = [])
  {
    $ancho_index = 20;
    $n = "\n";
    $s = " | ";
    $cantidad_columnas = count(reset($arr));
    $maximos = [4];
    $total = 7;
    if ($header) {
      array_unshift($arr, $header);
    }
    $arr = array_map('array_values', $arr);
    for ($c=0; $c < $cantidad_columnas; $c++) {
      $columna = array_column($arr, $c);
      $maximo = max([3, max(array_map('mb_strlen', $columna))]);
      $maximos[] = $maximo;
      $total += $maximo + 3;
    }
    echo $n;
    echo mb_str_pad(' ', $total + $ancho_index - 4, '-') . $n;
    if ($arr) {
      if ($header) {
        echo mb_str_pad(' N', 5, ' ', STR_PAD_LEFT) . ' |';
      }
      foreach ($arr as $i => $col) {
        if ($header && $i == 1) {
          echo mb_str_pad(' ', $total - 1, '-') . $n;
        }
        echo " ";
        if (!$header || $i > 0) {
          echo mb_str_pad($i, $ancho_index, ' ', STR_PAD_RIGHT) . $s;
        }
        foreach ($col as $c => $val) {
          echo mb_str_pad($val, $maximos[$c + 1], ' ');
          if ($c < ($cantidad_columnas - 1)) { echo $s; }
        }
        echo $n;
        // self::enter();
      }
    } else {
      echo "[Sin registros]\n";
    }
    echo mb_str_pad(' ', $total + $ancho_index - 4, '-') . $n;
    // echo "Presione [enter] para continuar...";
    // $h = fopen("php://stdin", "r"); $r = trim(fgets($h)); fclose($h);
  }
}

/**
    Console::startProgress(0, 1000);
    for ($n = 1; $n <= 1000; $n++) {
      usleep(1000);
      Console::updateProgress($n, 1000);
    }
    Console::endProgress();
 */

function mb_str_pad($input, $pad_length, $pad_string = ' ', $pad_style = STR_PAD_RIGHT, $encoding="UTF-8") {
  return str_pad($input, strlen($input)-mb_strlen($input,$encoding)+$pad_length, $pad_string, $pad_style);
}
