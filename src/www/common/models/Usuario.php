<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use common\behaviors\FechaBehavior;

/**
 * Usuario model
 */
class Usuario extends ActiveRecord implements IdentityInterface
{
  const ESTADO_BORRADO   = 0;
  const ESTADO_ACTIVO   =  1;
  const ESTADO_INACTIVO  = 2;
  const ESTADOS = [
    self::ESTADO_BORRADO   => 'Eliminado',
    self::ESTADO_ACTIVO    => 'Activo',
    self::ESTADO_INACTIVO  => 'Inactivo',
  ];

  public function estado()
  {
    return $this::ESTADOS[$this->estado];
  }

  public static function tableName()
  {
    return 'usuario';
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
      [['nombre', 'correo_electronico', 'contrasena', 'estado'], 'required'],
      [['correo_electronico'], 'unique'],
      [['nombre', 'apellido'], 'string', 'max' => 32],
      [['estado'], 'default', 'value' => self::ESTADO_ACTIVO],
      [['correo_electronico'], 'email'],
      [['estado'], 'in', 'range' => [
        self::ESTADO_ACTIVO,
        self::ESTADO_INACTIVO,
        self::ESTADO_BORRADO]],
    ];
  }

  public function getNombreCompleto()
  {
    return "$this->nombre $this->apellido";
  }

  public function beforeSave($insert)
  {
    if ($insert || $this->isAttributeChanged('contrasena')) {
      $this->generateAuthKey();
      $this->contrasena = Yii::$app->security->generatePasswordHash($this->contrasena);
    }
    return parent::beforeSave($insert);
  }

  public static function findIdentity($id)
  {
    return static::findOne(['id' => $id, 'estado' => self::ESTADO_ACTIVO]);
  }

  public static function findIdentityByAccessToken($token, $type = null)
  {
    throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
  }

  public function getId()
  {
    return $this->getPrimaryKey();
  }

  public function getAuthKey()
  {
    return $this->auth_key;
  }

  public function validateAuthKey($authKey)
  {
    return $this->getAuthKey() === $authKey;
  }

  public function validarContrasena($password)
  {
    return Yii::$app->security->validatePassword($password, $this->contrasena);
  }

  public function generateAuthKey()
  {
    $this->auth_key = Yii::$app->security->generateRandomString();
  }
}
