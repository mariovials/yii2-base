<?php

namespace backend\models;

use Yii;
use common\models\OrdenExamen;

/**
 * This is the model class for table "orden_examen_estado".
 *
 * @property int $id
 * @property int|null $orden_examen_id
 * @property int|null $estado
 * @property string|null $fecha
 * @property bool|null $manual
 *
 * @property OrdenExamen $ordenExamen
 */
class OrdenExamenEstado extends \yii\db\ActiveRecord
{
  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
    return 'orden_examen_estado';
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['orden_examen_id', 'estado'], 'default', 'value' => null],
      [['orden_examen_id', 'estado'], 'integer'],
      [['estado'], 'filter', 'filter' => 'intval', 'skipOnEmpty' => true],
      [['fecha'], 'datetime', 'format' => 'yyyy-MM-dd HH:mm:ss'],
      [['manual'], 'boolean'],
      [['orden_examen_id'], 'exist', 'skipOnError' => true,
        'targetClass' => OrdenExamen::class,
        'targetAttribute' => ['orden_examen_id' => 'id']],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels()
  {
    return [
      'id' => 'ID',
      'orden_examen_id' => 'Orden Examen ID',
      'estado' => 'Estado',
      'fecha' => 'Fecha',
      'manual' => 'Manual',
    ];
  }

  /**
   * Gets query for [[OrdenExamen]].
   *
   * @return \yii\db\ActiveQuery
   */
  public function getOrdenExamen()
  {
    return $this->hasOne(OrdenExamen::class, ['id' => 'orden_examen_id']);
  }
}
