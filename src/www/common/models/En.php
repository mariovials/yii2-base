<?php

namespace common\models;

use backend\components\ActiveRecord;

use Yii;

class En extends ActiveRecord
{

  public static function tableName()
  {
    return 'en';
  }

  public function rules()
  {
    return [
      [['publicacion_id'], 'filter', 'filter' => 'intval'],
      [['publicacion_id'], 'integer'],
      [['publicacion_id'], 'exist', 'skipOnError' => true,
        'targetClass' => Publicacion::class,
        'targetAttribute' => ['publicacion_id' => 'id']],

      [['idioma_id'], 'filter', 'filter' => 'intval'],
      [['idioma_id'], 'integer'],
      [['idioma_id'], 'exist', 'skipOnError' => true,
        'targetClass' => Idioma::class,
        'targetAttribute' => ['idioma_id' => 'id']],
    ];
  }

  public function getPublicacion()
  {
    return $this->hasOne(Publicacion::class, ['id' => 'publicacion_id']);
  }

  public function getIdioma()
  {
    return $this->hasOne(Idioma::class, ['id' => 'idioma_id']);
  }
}
