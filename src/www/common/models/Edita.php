<?php

namespace common\models;

use backend\components\ActiveRecord;

use Yii;

class Edita extends ActiveRecord
{

  public static function tableName()
  {
    return 'edita';
  }

  public function rules()
  {
    return [
      [['editorial_id'], 'filter', 'filter' => 'intval'],
      [['editorial_id'], 'integer'],
      [['editorial_id'], 'exist', 'skipOnError' => true,
        'targetClass' => Editorial::class,
        'targetAttribute' => ['editorial_id' => 'id']],

      [['publicacion_id'], 'filter', 'filter' => 'intval'],
      [['publicacion_id'], 'integer'],
      [['publicacion_id'], 'exist', 'skipOnError' => true,
        'targetClass' => Publicacion::class,
        'targetAttribute' => ['publicacion_id' => 'id']],
    ];
  }

  public function afterSave($insert, $changedAttributes)
  {
    $this->editorial->save();
    parent::afterSave($insert, $changedAttributes);
  }

  public function afterDelete()
  {
    if (!$this->editorial->publicaciones) {
      $this->editorial->delete();
    }
    parent::afterDelete();
  }

  public function getEditorial()
  {
    return $this->hasOne(Editorial::class, ['id' => 'editorial_id']);
  }

  public function getPublicacion()
  {
    return $this->hasOne(Publicacion::class, ['id' => 'publicacion_id']);
  }
}
