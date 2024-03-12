<?php

namespace common\models;

use Yii;
use backend\components\ActiveRecord;
use yii\web\NotFoundHttpException;

class Configuracion extends ActiveRecord
{

  public static function tableName()
  {
    return 'configuracion';
  }

  public function getNameAttribute()
  {
    return $this->nombre;
  }

  public function rules()
  {
    return [
      [['nombre', 'codigo', 'tipo_php'], 'required'],
      [['tipo_php', 'tipo'], 'default', 'value' => null],
      [['descripcion'], 'string'],
      [['nombre', 'valor'], 'string', 'max' => 255],
      [['codigo'], 'string', 'max' => 32],
    ];
  }

  public function attributeLabels()
  {
    return [
      'id' => 'ID',
      'codigo' => 'Código',
      'descripcion' => 'Descripción',
      'nombre' => 'Nombre',
      'tipo' => 'Tipo',
      'tipo_php' => 'Tipo PHP',
      'valor' => 'Valor',
    ];
  }

  public function getValor()
  {
    $valor = $this->valor;
    if ($this->tipo_php == 'time') {
      $valor = date('H:i', strtotime($this->valor));
    } else {
      settype($valor, $this->tipo_php);
    }
    Yii::$app->params['configuracion'][$this->codigo] = $valor;
    return $valor;
  }

  public function valorHtml()
  {
    if ($this->tipo_php == 'boolean') {
      return $this->valor ? 'Si' : 'No';
    }
    if ($this->tipo == 'parrafo') {
      return nl2br($this->valor);
    }
    if ($this->tipo == 'precio') {
      return "$ ". number_format($this->valor, 0, ',', '.');
    }
    if ($this->tipo == 'dias') {
      return $this->valor . ' dias';
    }
    if ($this->tipo == 'porcentaje') {
      return $this->valor . ' %';
    }
    return $this->valor;
  }

  /**
   * Obtiene el valor formateado segun el tipo de una configuracion
   * segun su codigo
   * @param  string $codigo
   * @return mxed
   * @author Mario Vial <mvial@ubiobio.cl> 06/09/2017 16:20
   */
  public static function html($codigo)
  {
    return Configuracion::findModel($codigo)['html'];
  }

  public static function valor($codigo)
  {
    return Configuracion::findModel($codigo)['valor'];
  }

  public static function findModel($codigo)
  {
    if (isset(Yii::$app->params['configuracion'][$codigo])) {
      return Yii::$app->params['configuracion'][$codigo];
    } else {
      $model = Configuracion::findOne(['codigo' => $codigo]);
      if ($model) {
        $valor = $model->valor;
        Yii::$app->params['configuracion'][$codigo] = [
          'valor' => $valor,
          'html' => $model->valorHtml($valor),
        ];
        return Yii::$app->params['configuracion'][$codigo];
      } else {
        throw new NotFoundHttpException("No existe configuración '$codigo'");
      }
    }
  }

  public function afterSave($insert, $changedAttributes)
  {
    parent::afterSave($insert, $changedAttributes);
  }

  public function opciones($attribute)
  {
    switch ($attribute) {
      case 'tipo_php':
        return [
          'integer' => 'Integer (Número entero)' ,
          'string' => 'String (Texto)',
          'boolean' => 'Boolean (Si/No)',
          'time' => 'Time (Hora)',
        ];
        break;
      case 'tipo':
        return [
          'usuario' => 'Seleccionador de usuario',
        ];
        break;
      default:
        return null;
        break;
    }
  }
}
