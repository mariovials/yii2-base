<?php

namespace backend\models;

use Yii;
use common\behaviors\FechaBehavior;
use common\models\Archivo;

/**
 * This is the model class for table "admin.examen_foto".
 *
 * @property int $id
 * @property int $examen_id
 * @property int $archivo_id
 * @property string $fecha_creacion
 * @property string $fecha_edicion
 */
class ExamenImagen extends \yii\db\ActiveRecord
{
  public $imagen = null; // se sube a examen

  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
    return 'examen_imagen';
  }

  /**
   * {@inheritdoc}
   */
  public function behaviors()
  {
    return [
      FechaBehavior::class,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['examen_id'], 'required'],
      [['examen_id', 'archivo_id'], 'default', 'value' => null],
      [['examen_id', 'archivo_id'], 'integer'],
      [['fecha_creacion', 'fecha_edicion'],
        'datetime', 'format' => 'yyyy-MM-dd HH:mm:ss'],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels()
  {
    return [
      'id' => 'ID',
      'examen_id' => 'Examen ID',
      'archivo_id' => 'Archivo ID',
      'fecha_creacion' => 'Fecha de creación',
      'fecha_edicion' => 'Fecha de edición',
    ];
  }

  public function getArchivo()
  {
    return $this->hasOne(Archivo::class, ['id' => 'archivo_id']);
  }

  /**
   * {@inheritdoc}
   */
  public function beforeSave($insert)
  {
    if ($this->imagen) {
      $archivo = new Archivo();
      $archivo->archivo = $this->imagen;
      if ($archivo->save()) {
        $this->archivo_id = $archivo->id;

        // copiar a web
        copy(Yii::getAlias('@backend/web' . $archivo->ruta),
          Yii::getAlias('@frontend/web' . $archivo->ruta));
      } else {
        die('archivo no save');
        var_dump($archivo->errors);
      }
    }
    return parent::beforeSave($insert);
  }

  public function beforeDelete()
  {
    $this->archivo->delete();
    @unlink(Yii::getAlias('@frontend/web') . $this->archivo->ruta);
    return parent::beforeDelete();
  }
}
