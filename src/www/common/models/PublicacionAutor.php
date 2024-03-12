<?php

namespace common\models;
use backend\components\ActiveRecord;

use Yii;

class PublicacionAutor extends ActiveRecord
{

  public static function tableName()
  {
    return 'publicacion_autor';
  }

  public function rules()
  {
    return [
      [['publicacion_id'], 'integer'],
      [['publicacion_id'], 'exist', 'skipOnError' => true,
        'targetClass' => Publicacion::class,
        'targetAttribute' => ['publicacion_id' => 'id']],
      [['autor_id'], 'integer'],
      [['autor_id'], 'exist', 'skipOnError' => true,
        'targetClass' => Autor::class,
        'targetAttribute' => ['autor_id' => 'id']],
    ];
  }

  public function getAutor()
  {
    return $this->hasOne(Autor::class, ['id' => 'autor_id']);
  }

  public function getPublicacion()
  {
    return $this->hasOne(Publicacion::class, ['id' => 'publicacion_id']);
  }
}
