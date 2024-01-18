<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
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

  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
    return 'usuario';
  }

  /**
   * {@inheritdoc}
   */
  public function behaviors()
  {
    return [
      FechaBehavior::class,
    ];
  }

  /**
   * {@inheritdoc}
   */
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

  /**
   * Generates password hash from password and sets it to the model
   *
   * @param string $password
   */
  public function establecerContrasena($contrasena)
  {
  }

  /**
   * {@inheritdoc}
   */
  public static function findIdentity($id)
  {
    return static::findOne(['id' => $id, 'estado' => self::ESTADO_ACTIVO]);
  }

  /**
   * {@inheritdoc}
   */
  public static function findIdentityByAccessToken($token, $type = null)
  {
    throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
  }

  /**
   * {@inheritdoc}
   */
  public function getId()
  {
    return $this->getPrimaryKey();
  }

  /**
   * {@inheritdoc}
   */
  public function getAuthKey()
  {
    return $this->auth_key;
  }

  /**
   * {@inheritdoc}
   */
  public function validateAuthKey($authKey)
  {
    return $this->getAuthKey() === $authKey;
  }

  /**
   * Validates password
   *
   * @param string $password password to validate
   * @return bool if password provided is valid for current usuario
   */
  public function validarContrasena($password)
  {
    return Yii::$app->security->validatePassword($password, $this->contrasena);
  }

  /**
   * Generates "remember me" authentication key
   */
  public function generateAuthKey()
  {
    $this->auth_key = Yii::$app->security->generateRandomString();
  }
}
