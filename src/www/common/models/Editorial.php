<?php

namespace common\models;

use Yii;
use backend\components\ActiveRecord;
use common\helpers\StringHelper;
use yii\helpers\Url;


class Editorial extends ActiveRecord
{

  public static function tableName()
  {
    return 'editorial';
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
    return Url::to(["/editorial/ver", 'slug' => $this->slug]);
  }

  public function beforeSave($insert)
  {
    if ($insert) {
      $this->fecha_creacion = date('Y-m-d H:i:s');
    } else {
      $this->fecha_edicion = date('Y-m-d H:i:s');
    }
    if ($this->isAttributeChanged('nombre')) {
      $this->slug = StringHelper::slugify($this->nombre);
    }
    return parent::beforeSave($insert);
  }

  public function afterSave($insert, $changedAttributes)
  {
    if (array_key_exists('nombre', $changedAttributes)) {
      if (!$insert) {
        foreach ($this->publicaciones as $publicacion) {
          $publicacion->editorial = implode(', ', $publicacion
            ->getEditas()
            ->joinWith('editorial')
            ->orderBy('orden, nombre')
            ->select(['editorial.nombre'])
            ->column());
          $publicacion->save();
        }
      }
    }
    $this->updateAttributes([
      'publicados' => $this->getPublicaciones()->count(),
    ]);
    parent::afterSave($insert, $changedAttributes);
  }

  public function beforeDelete()
  {
    foreach ($this->publicaciones as $publicacion) {
      $actuales = array_map('trim', explode(',', $publicacion->editorial));
      $nuevos = array_filter(array_diff($actuales, [$this->nombre]));
      $publicacion->autor = implode(', ', $nuevos);
      $publicacion->save();
    }
    return parent::beforeDelete();
  }

  public function getPublicaciones()
  {
    return $this->hasMany(Publicacion::class, ['id' => 'publicacion_id'])
      ->via('editas');
  }

  public function getEditas()
  {
    return $this->hasMany(Edita::class, ['editorial_id' => 'id']);
  }

  public function combinar()
  {
    $editorial = Editorial::find()
      ->where(['AND',
        ['<>', 'id', $this->id],
        ['slug' => StringHelper::slugify($this->nombre)],
      ])->one();
    if ($editorial) {
      $editorial->updateAttributes([
        'nombre' => bin2hex(random_bytes(5)),
        'slug' => bin2hex(random_bytes(5)),
      ]);
      Edita::deleteAll(new \yii\db\Expression("
        editorial_id = {$editorial->id}
        AND EXISTS (
          SELECT 1
          FROM edita e
          WHERE e.publicacion_id = edita.publicacion_id
            AND editorial_id = {$this->id})
      "));
      Edita::updateAll(
        ['editorial_id' => $this->id],
        ['editorial_id' => $editorial->id]);
      $editorial->delete();
      $this->save();
    }
    return true;
  }

}
