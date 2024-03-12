<?php

namespace common\models;

use backend\components\ActiveRecord;
use common\helpers\ArrayHelper;
use yii\helpers\Url;

use Yii;

class Autor extends ActiveRecord
{

  public static function tableName()
  {
    return 'autor';
  }

  public function rules()
  {
    return [
      [['persona_id'], 'filter', 'filter' => 'intval'],
      [['persona_id'], 'integer'],
      [['persona_id'], 'exist', 'skipOnError' => true,
        'targetClass' => Persona::class,
        'targetAttribute' => ['persona_id' => 'id']],

      [['publicacion_id'], 'filter', 'filter' => 'intval'],
      [['publicacion_id'], 'integer'],
      [['publicacion_id'], 'exist', 'skipOnError' => true,
        'targetClass' => Publicacion::class,
        'targetAttribute' => ['publicacion_id' => 'id']],
    ];
  }

  public function getNombre()
  {
    return $this->persona->nombre;
  }

  public function getUrl()
  {
    return Url::to(["/autor/ver", 'slug' => $this->persona->slug]);
  }

  public function beforeSave($insert)
  {
    if ($insert) {
      $this->fecha_creacion = date('Y-m-d H:i:s');
    } else {
      $this->fecha_edicion = date('Y-m-d H:i:s');
    }
    return parent::beforeSave($insert);
  }

  public function afterSave($insert, $changedAttributes)
  {
    parent::afterSave($insert, $changedAttributes);
  }

  public function afterDelete()
  {
    if (!$this->persona->publicaciones) {
      $this->persona->delete();
    }
    parent::afterDelete();
  }

  public function getPersona()
  {
    return $this->hasOne(Persona::class, ['id' => 'persona_id']);
  }

  public function getPublicaciones()
  {
    return Publicacion::find()
      ->joinWith('autores')
      ->where(['persona_id' => $this->persona_id]);
  }
}
