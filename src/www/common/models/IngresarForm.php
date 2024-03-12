<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class IngresarForm extends Model
{
  public $usuario;
  public $contrasena;
  public $recordarme = true;

  private $_user;

  public function rules()
  {
    return [
      [['usuario', 'contrasena'], 'required'],
      ['recordarme', 'boolean'],
      ['contrasena', 'validarContrasena'],
    ];
  }

  public function validarContrasena($attribute, $params)
  {
    if (!$this->hasErrors()) {
      $usuario = $this->getUsuario();
      if (!$usuario || !$usuario->validarContrasena($this->contrasena)) {
        $this->addError($attribute, 'Usuario o contraseña incorrecta.');
      }
    }
  }

  public function ingresar()
  {
    if ($this->validate()) {
      return Yii::$app->user->login($this->getUsuario(), $this->recordarme ? 3600 * 24 * 30 : 0);
    }
    return false;
  }

  protected function getUsuario()
  {
    if ($this->_user === null) {
      $this->_user = Usuario::find()
        ->where(['correo_electronico' => $this->usuario])
        ->one();
    }
    return $this->_user;
  }
}
