<?php
/**
 *   Valida un RUN chileno
 *   @author Mario Vial <mariovials@gmail.com> 2014-03-27 18:16
 */

namespace common\validators;

class RunValidator extends \yii\validators\Validator
{
  public $normalizar = true;

  /**
   * Validates the attribute of the model.
   * If there is any error, the error message is added to the model.
   * @param Validator $model the model being validated
   * @param string $attribute the attribute being validated
   */

  public function validateAttribute($model, $attribute) {
    if (!$this->validar($model->{$attribute})) {
      $this->addError($model, $attribute, 'No es un RUN válido');
    } else {
      if ($this->normalizar) {
        $model->{$attribute} = $this->normalizar($model->{$attribute});
      }
    }
  }

  public function clientValidateAttribute($model, $attribute, $view)
  {
    return <<<JS
    rut = value;

    if (rut == '') return true;

    // Despejar Puntos
    var valor = value.replace(/\./g, '');

    // Despejar Guión
    valor = valor.replace('-','');

    // Aislar Cuerpo y Dígito Verificador
    cuerpo = valor.slice(0,-1);
    dv = valor.slice(-1).toUpperCase();

    // Formatear RUN
    //rut.value = cuerpo + '-' + dv

    // Si no cumple con el mínimo ej. (n.nnn.nnn)

    if (cuerpo.length < 7) { messages.push("RUT Incompleto"); return false;}

    // Calcular Dígito Verificador
    suma = 0;
    multiplo = 2;

    // Para cada dígito del Cuerpo
    for (i=1;i<=cuerpo.length;i++) {

        // Obtener su Producto con el Múltiplo Correspondiente
        index = multiplo * valor.charAt(cuerpo.length - i);

        // Sumar al Contador General
        suma = suma + index;

        // Consolidar Múltiplo dentro del rango [2,7]
        if (multiplo < 7) { multiplo = multiplo + 1; } else { multiplo = 2; }

    }

    // Calcular Dígito Verificador en base al Módulo 11
    dvEsperado = 11 - (suma % 11);

    dvOriginal = dv;

    // Casos Especiales (0 y K)
    dv = (dv == 'K')?10:dv;
    dv = (dv == 0)?11:dv;

    // Validar que el Cuerpo coincide con su Dígito Verificador
    if (dvEsperado != dv) {
      messages.push("RUT Inválido");
    } else {
      cuerpo = parseInt(cuerpo).toLocaleString('es-CL')
      $(attribute.input).val(cuerpo + '-' + dvOriginal);
    }

JS;
  }

  /**
   * Valida el RUN respecto a su DV (no al formato)
   */
  public function validar($run)
  {
    $run = self::limpiar($run); // deja el RUN limpio (sin otros caracteres)
    $d = substr($run, -1); // obtiene el DV (el último caracter)
    $r = substr($run, 0, -1); // obtiene el RUN (solo números)
    $s = 1;
    for ($m = 0; $r != 0; $r /= 10)
      $s = ($s + $r % 10 * (9 - $m++ % 6)) % 11;
    $dv = chr($s ? $s + 47 : 75);
    return ($d == $dv);
  }

  /**
   * Retorna solo los caracteres compomentes del run, sin puntos, ni guión,
   * ni otros
   */
  public function limpiar($run)
  {
    // obtiene el DV (el último caracter) (en mayúscula en caso de ser K)
    $dv = strtoupper(substr($run, -1));
    // obtiene el RUN (solo números)
    $run = preg_replace("/[^0-9]/","",substr($run, 0, -1));
    return $run.$dv;
  }

  /**
   * Retorna el RUN en el formato 12.456.789-0
   * Retorna el RUN en el formato 12.456.789-K
   * Si $sin_puntos es TRUE, lo retorna 12456789-0
   */
  public function normalizar($run, $sin_puntos=false)
  {
    $run = self::limpiar($run);
    if ($run) {
      $dig = strtoupper(substr($run, -1));
      $run = substr($run, 0, -1);
      if ($sin_puntos)
        return ltrim($run, '0').'-'.$dig;
      return number_format($run, 0, ',', '.').'-'.$dig;
    } else return null;
  }
}
