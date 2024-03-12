<?php

namespace common\models;
use backend\components\ActiveRecord;
use common\helpers\StringHelper;

use Yii;
use yii\helpers\Url;

class Publicacion extends ActiveRecord
{
  public $file = null;

  const LIBRO = 1;
  const REVISTA = 2;

  const TIPOS = [
    self::LIBRO => 'Libro',
    self::REVISTA => 'Revista',
  ];

  public static function tableName()
  {
    return 'publicacion';
  }

  public function getUrl()
  {
    return Url::to(["/publicacion/ver", 'slug' => $this->slug]);
  }

  public function rules()
  {
    return [
      [['nombre', 'tipo', 'periodo'], 'required'],

      [['tipo', 'periodo', 'mes', 'dia', 'orden', 'disponible'],
        'default', 'value' => null],
      [['tipo', 'periodo', 'mes', 'dia', 'orden'], 'integer'],
      [['nombre', 'autor', 'editor', 'editorial', 'isbn', 'issn', 'idioma', 'link',
        'descripcion'], 'string'],
      [['disponible', 'visible'], 'boolean'],
      [['link'], 'url'],

      [['archivo_id'], 'default', 'value' => null],
      [['archivo_id'], 'integer'],
      [['archivo_id'], 'exist', 'skipOnError' => true,
        'targetClass' => Archivo::class,
        'targetAttribute' => ['archivo_id' => 'id']],
    ];
  }

  public function attributeLabels()
  {
    return [
      'id' => 'ID',
      'nombre' => 'Nombre',
      'tipo' => 'Tipo',
      'autor' => 'Autor',
      'editor' => 'Editores',
      'editorial' => 'Editorial',
      'isbn' => 'ISBN',
      'issn' => 'ISSN',
      'idioma' => 'Idioma',
      'link' => 'Link',
      'descripcion' => 'Descripción',
      'periodo' => 'Fecha',
      'mes' => 'Mes',
      'dia' => 'Día',
      'disponible' => 'Disponible',
      'archivo_id' => 'Portada',
      'fecha_creacion' => 'Creación',
      'fecha_edicion' => 'Edición',
    ];
  }

  public function beforeSave($insert)
  {
    if ($insert) {
      $this->fecha_creacion = date('Y-m-d H:i:s');
    }
    $this->fecha_edicion = date('Y-m-d H:i:s');

    if ($this->file) {
      $portadaAnterior = $this->portada;
      $archivo = new Archivo();
      $archivo->archivo = $this->file;
      if ($archivo->save()) {
        $this->archivo_id = $archivo->id;
        if ($portadaAnterior) {
          $portadaAnterior->delete();
        }
      }
    }
    if ($this->isAttributeChanged('nombre')) {
      $this->slug = StringHelper::slugify($this->nombre);
    }
    if ($this->isAttributeChanged('autor')) {
      foreach (array_filter(array_map('trim', array_diff(
        explode(',', $this->autor),
        explode(',', $this->getOldAttribute('autor'))))) as $nombre) {
        if (!Persona::findBySlug($nombre)) {
          (new Persona(['nombre' => $nombre]))->save();
        }
      }
    }
    if ($this->isAttributeChanged('editor')) {
      foreach (array_filter(array_map('trim', array_diff(
        explode(',', $this->editor),
        explode(',', $this->getOldAttribute('editor'))))) as $nombre) {
        if (!Persona::findBySlug($nombre)) {
          (new Persona(['nombre' => $nombre]))->save();
        }
      }
    }
    if ($this->isAttributeChanged('editorial')) {
      foreach (array_filter(array_map('trim', array_diff(
        explode(',', $this->editorial),
        explode(',', $this->getOldAttribute('editorial'))))) as $nombre) {
        if (!Editorial::findBySlug($nombre)) {
          (new Editorial(['nombre' => $nombre]))->save();
        }
      }
    }
    if ($this->isAttributeChanged('idioma')) {
      foreach (array_filter(array_map('trim', array_diff(
        explode(',', $this->idioma),
        explode(',', $this->getOldAttribute('idioma'))))) as $nombre) {
        if (!Idioma::findBySlug($nombre)) {
          (new Idioma(['nombre' => $nombre]))->save();
        }
      }
    }
    return parent::beforeSave($insert);
  }

  public function afterSave($insert, $changedAttributes)
  {
    if (array_key_exists('autor', $changedAttributes)) {
      Autor::deleteAll(['publicacion_id' => $this->id]);
      $autores = array_filter(array_map('trim', explode(',', $this->autor)));
      foreach ($autores as $i => $nombre) {
        (new Autor([
          'publicacion_id' => $this->id,
          'persona_id' => Persona::findBySlug($nombre)->id,
          'orden' => ($i + 1),
        ]))->save();
      }
    }
    if (array_key_exists('editor', $changedAttributes)) {
      Editor::deleteAll(['publicacion_id' => $this->id]);
      $editores = array_filter(array_map('trim', explode(',', $this->editor)));
      foreach ($editores as $i => $nombre) {
        (new Editor([
          'publicacion_id' => $this->id,
          'persona_id' => Persona::findBySlug($nombre)->id,
          'orden' => ($i + 1),
        ]))->save();
      }
    }
    if (array_key_exists('editorial', $changedAttributes)) {
      Edita::deleteAll(['publicacion_id' => $this->id]);
      $editoriales = array_filter(array_map('trim', explode(',', $this->editorial)));
      foreach ($editoriales as $i => $nombre) {
        (new Edita([
          'publicacion_id' => $this->id,
          'editorial_id' => Editorial::findBySlug($nombre)->id,
          'orden' => ($i + 1),
        ]))->save();
      }
    }
    if (array_key_exists('idioma', $changedAttributes)) {
      En::deleteAll(['publicacion_id' => $this->id]);
      $idiomas = array_filter(array_map('trim', explode(',', $this->idioma)));
      foreach ($idiomas as $i => $nombre) {
        (new En([
          'publicacion_id' => $this->id,
          'idioma_id' => Idioma::findBySlug($nombre)->id,
          'orden' => ($i + 1),
        ]))->save();
      }
    }
    parent::afterSave($insert, $changedAttributes);
  }

  public function afterDelete()
  {
    if ($this->portada) {
      $this->portada->delete();
    }
    parent::afterDelete();
  }

  public function getPortada()
  {
    return $this->hasOne(Archivo::class, ['id' => 'archivo_id']);
  }

  public function getAutores()
  {
    return $this->hasMany(Autor::class, ['publicacion_id' => 'id'])
      ->orderBy('orden');
  }

  public function getEditores()
  {
    return $this->hasMany(Editor::class, ['publicacion_id' => 'id'])
      ->orderBy('orden');
  }

  public function getEditoriales()
  {
    return $this->hasMany(Editorial::class, ['id' => 'editorial_id'])
      ->via('editas');
  }

  public function getEditas()
  {
    return $this->hasMany(Edita::class, ['publicacion_id' => 'id'])
      ->orderBy('orden');
  }

  public function getIdiomas()
  {
    return $this->hasMany(Idioma::class, ['id' => 'idioma_id'])
      ->joinWith('en')
      ->via('en');
  }

  public function getEn()
  {
    return $this->hasMany(En::class, ['publicacion_id' => 'id'])
      ->orderBy('orden');
  }

  public function fecha()
  {
    return $this->periodo .
      ($this->mes ? "/{$this->mes}" : '') .
      ($this->dia ? "/{$this->dia}" : '');
  }

  public function tipo()
  {
    return $this::TIPOS[$this->tipo];
  }

  public function tipoIcono()
  {
    return '<span class="mdi mdi-book"></span>';
  }

  public function quitarAutor($nombre)
  {
    $actuales = array_map('trim', explode(',', $this->autor));
    $nuevos = array_diff($actuales, [$nombre]);
    $this->updateAttributes(['autor' => implode(', ', $nuevos)]);
  }

  public function quitarEditor($nombre)
  {
    $actuales = array_map('trim', explode(',', $this->editor));
    $nuevos = array_diff($actuales, [$nombre]);
    $this->updateAttributes(['editor' => implode(', ', $nuevos)]);
  }

}
