<?php

namespace common\models;

use backend\components\ActiveRecord;
use common\helpers\StringHelper;

use Yii;

class Persona extends ActiveRecord
{

  public static function tableName()
  {
    return 'persona';
  }

  public function rules()
  {
    return [
      [['nombre'], 'unique'],
      [['nombre'], 'required'],
      [['nombre'], 'filter', 'filter' => 'trim'],
      [['nombre'], 'string', 'min' => 1, 'max' => 256],
      [['slug'], 'string', 'min' => 1, 'max' => 256],
    ];
  }

  public function attributeLabels()
  {
    return [
      'nombre' => 'Nombre',
    ];
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
          $publicacion->autor = implode(', ', $publicacion
            ->getAutores()
            ->joinWith('persona')
            ->orderBy('orden')
            ->select(['persona.nombre'])
            ->column());
          $publicacion->save();
        }
      }
      $this->updateAttributes([
        'editados' => $this->getEditores()->count(),
        'publicados' => $this->getAutores()->count(),
      ]);
    }
    parent::afterSave($insert, $changedAttributes);
  }

  public function beforeDelete()
  {
    foreach ($this->publicaciones as $publicacion) {
      $publicacion->quitarAutor($this->nombre);
      $publicacion->quitarEditor($this->nombre);
    }
    return parent::beforeDelete();
  }

  public function getAutores()
  {
    return $this->hasMany(Autor::class, ['persona_id' => 'id']);
  }

  public function getEditores()
  {
    return $this->hasMany(Editor::class, ['persona_id' => 'id']);
  }

  public function getPublicaciones($como = 'todas')
  {
    if ($como == 'autor') {
      $q = Publicacion::find()
        ->joinWith('autores')
        ->where(['persona_id' => $this->id]);
    } elseif ($como == 'editor') {
      $q = Publicacion::find()
        ->joinWith('editores')
        ->where(['persona_id' => $this->id]);
    } else {
      $q = Publicacion::find()
        ->joinWith('editores')
        ->joinWith('autores')
        ->where(['OR',
          ['autor.persona_id' => $this->id],
          ['editor.persona_id' => $this->id],
      ]);
    }
    $q->multiple = true;
    return $q;
  }

  public function combinar()
  {
    $persona = Persona::findBySlug($this->nombre);
    if ($persona) {
      foreach ($this->publicaciones as $publicacion) {
        $publicacion->quitarAutor($this->getOldAttribute('nombre'));
        $publicacion->quitarEditor($this->getOldAttribute('nombre'));
      }
      Autor::deleteAll(['AND',
        ['persona_id' => $persona->id],
        ['publicacion_id' => Autor::find()
          ->select('publicacion_id')
          ->where(['persona_id' => $this->id])]
      ]);
      Editor::deleteAll(['AND',
        ['persona_id' => $persona->id],
        ['publicacion_id' => Editor::find()
          ->select('publicacion_id')
          ->where(['persona_id' => $this->id])]
      ]);
      Autor::updateAll(
        ['persona_id' => $this->id],
        ['persona_id' => $persona->id]);
      Editor::updateAll(
        ['persona_id' => $this->id],
        ['persona_id' => $persona->id]);
      $persona->delete();
      $this->save();
    }
    return true;
  }

}
