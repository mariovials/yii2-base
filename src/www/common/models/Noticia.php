<?php

namespace common\models;
use backend\components\ActiveRecord;

use Yii;

/**
 * This is the model class for table "noticia".
 *
 * @property int $id
 * @property string $titulo
 * @property string $contenido
 * @property string $fecha
 */
class Noticia extends ActiveRecord
{
  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
    return 'noticia';
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['titulo', 'contenido', 'fecha'], 'required'],
      [['contenido'], 'string'],
      [['fecha'], 'safe'],
      [['titulo'], 'string', 'max' => 255],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels()
  {
    return [
      'id' => 'ID',
      'titulo' => 'Titulo',
      'contenido' => 'Contenido',
      'fecha' => 'Fecha',
    ];
  }
}
