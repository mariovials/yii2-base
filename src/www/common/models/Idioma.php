<?php

namespace common\models;

use backend\components\ActiveRecord;
use common\helpers\StringHelper;
use yii\helpers\Url;

use Yii;

class Idioma extends ActiveRecord
{

  public static function tableName()
  {
    return 'idioma';
  }

  public function rules()
  {
    return [
      [['nombre'], 'unique'],
      [['nombre'], 'required'],
      [['nombre'], 'filter', 'filter' => 'trim'],
      [['nombre'], 'string', 'min' => 1, 'max' => 256],

      [['slug'], 'string', 'min' => 1, 'max' => 256],
      [['slug'], 'unique'],
    ];
  }

  public function attributeLabels()
  {
    return [
      'nombre' => 'Nombre',
      'publicados' => 'Publicaciones',
    ];
  }

  public function getUrl()
  {
    return Url::to(["/idioma/ver", 'slug' => $this->slug]);
  }

  public function beforeSave($insert)
  {
    if ($insert) {
      $this->fecha_creacion = date('Y-m-d H:i:s');
    }
    if ($this->isAttributeChanged('nombre')) {
      $this->slug = StringHelper::slugify($this->nombre);
    }
    return parent::beforeSave($insert);
  }

  public function getPublicaciones()
  {
    return $this->hasMany(Publicacion::class, ['id' => 'publicacion_id'])
      ->via('en');
  }

  public function getEn()
  {
    return $this->hasMany(En::class, ['idioma_id' => 'id'])
      ->orderBy('orden');
  }

}
