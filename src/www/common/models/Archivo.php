<?php

namespace common\models;

use Yii;
use common\behaviors\FechaBehavior;

class Archivo extends \yii\db\ActiveRecord
{
  public $archivo = null;

  public static function tableName()
  {
    return 'archivo';
  }

  public function behaviors()
  {
    return [
      FechaBehavior::class,
    ];
  }

  public function rules()
  {
    return [
      [['tipo', 'size'], 'default', 'value' => null],
      [['tipo', 'size'], 'integer'],
      [['nombre', 'basename', 'filename', 'ruta', 'ruta_web', 'ruta_min'], 'string', 'max' => 255],
      [['mime_type'], 'string', 'max' => 128],
      [['extension'], 'string', 'max' => 5],
    ];
  }

  public function attributeLabels()
  {
    return [
      'id' => 'ID',
      'tipo' => 'Tipo',

      'mime_type' => 'Tipo MIME',
      'extension' => 'Extensión',
      'size' => 'Tamaño',
      'basename' => 'Nombre de archivo',
      'filename' => 'Nombre completo',

      'nombre' => 'Nombre',
      'ruta' => 'Ruta',
      'ruta_web' => 'Ruta Web',
      'ruta_min' => 'Ruta Min',
    ];
  }

  public function icono()
  {
    return [
      'doc'  => 'file-word-outline',
      'docx' => 'file-word',
      'ppt'  => 'file-powerpoint-outline',
      'pptx' => 'file-powerpoint',
      'xls'  => 'file-excel-outline',
      'xlsx' => 'file-excel',
      'webp' => 'file-image',
      'jpeg' => 'image',
      'jpg'  => 'image',
      'png'  => 'image-outline',
      'rar'  => 'folder-zip',
      'zip'  => 'folder-zip-outline',
      'txt'  => 'text-box-outline',
      'pdf'  => 'file-pdf-box',
    ][$this->extension] ?? 'file';
  }

  public function beforeSave($insert)
  {
    if ($this->archivo) {
      $this->filename = $this->archivo->name;
      $this->mime_type = $this->archivo->type;
      $this->size = $this->archivo->size;
      $this->basename = $this->archivo->baseName;
      $this->extension = $this->archivo->extension;
      $this->nombre = $this->filename;
    }
    return parent::beforeSave($insert);
  }

  public function afterSave($insert, $changedAttributes)
  {
    if ($this->archivo) {
      $nombre = "{$this->id}_{$this->filename}";
      $ruta = '/archivos/' . $nombre;
      if ($this->archivo->saveAs(Yii::getAlias('@frontend/web') . $ruta)) {
        $this->updateAttributes(['ruta' => $ruta]);
        if ($this->esImagen()) {
          // hacer web
          // hacer min
          $ruta_web = "{$this->id}_{$this->basename}_web.{$this->extension}";
          $ruta_min = "{$this->id}_{$this->basename}_min.{$this->extension}";
          $this->updateAttributes([
            'ruta_web' => '/archivos/' . $ruta_web,
            'ruta_min' => '/archivos/' . $ruta_min,
          ]);
        }
      }
    }
    parent::afterSave($insert, $changedAttributes);
  }

  public function getRutaCompleta()
  {
    return Yii::getAlias('@frontend/web') . $this->ruta;
  }

  public function getRutaWeb()
  {
    return Yii::$app->urlManagerFrontend->createAbsoluteUrl($this->ruta);
  }

  public function esImagen()
  {
    return in_array($this->extension, ['png', 'jpg', 'jpeg']);
  }

  public function beforeDelete()
  {
    @unlink(Yii::getAlias('@frontend/web') . $this->ruta);
    @unlink(Yii::getAlias('@frontend/web') . $this->ruta_web);
    @unlink(Yii::getAlias('@frontend/web') . $this->ruta_min);
    return parent::beforeDelete();
  }
}
