<?php

namespace console\controllers;

use common\models\Usuario;
use console\components\Console;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * Mi propia clase de migración
 * @author Mario Vial <mvial@ubiobio.cl> 10/12/2020 14:08
 */
class UsuarioController extends Controller
{
  public function actionAgregar($nombre, $correo_electronico, $contraseña)
  {
    $model = new Usuario;
    $model->nombre = $nombre;
    $model->correo_electronico = $correo_electronico;
    $model->contrasena = $contraseña;
    $model->estado = Usuario::ESTADO_ACTIVO;
    if ($model->save()) {
      Console::echo($this->ansiFormat(
        "Usuario $nombre <{$correo_electronico}> creado exitosamente!",
        Console::FG_GREEN));
    } else {
      Console::echo($this->ansiFormat('Error al crear el usuario', Console::FG_RED));
      foreach($model->errors as $attribute => $errors) {
        foreach($errors as $error) {
          Console::echo(" - $error");
        }
      }
    }
  }
}
