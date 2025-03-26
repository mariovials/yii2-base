<?php

namespace backend\controllers;

use yii\filters\VerbFilter;
use backend\components\Controller;
use common\models\Usuario;

/**
 * Site controller
 */
class UsuarioController extends Controller
{
  /**
   * {@inheritdoc}
   */
  public function behaviors()
  {
    return array_merge(parent::behaviors(), [
      'verbs' => [
        'class' => VerbFilter::class,
        'actions' => [
          'eliminar' => ['post'],
        ],
      ],
    ]);
  }

  public function actionLista()
  {
    return $this->render('lista');
  }

  public function actionAgregar()
  {
    $model = new Usuario();
    if ($this->request->isPost) {
      if ($model->load($this->request->post()) && $model->save()) {
        return $this->redirect(['ver', 'id' => $model->id]);
      }
    } else {
      $model->loadDefaultValues();
    }
    return $this->render('agregar', ['model' => $model]);
  }

  public function actionVer($id)
  {
    return $this->render('ver', ['model' => Usuario::findOne($id)]);
  }

  public function actionEditar($id)
  {
    $model = Usuario::findOne($id);
    if ($this->request->isPost
      && $model->load($this->request->post())
      && $model->save()) {
      return $this->redirect($this->request->get('to', ['ver', 'id' => $model->id]));
    }
    return $this->render('editar', ['model' => $model]);
  }

  public function actionCambiarContrasena($id)
  {
    $model = Usuario::findOne($id);
    if ($this->request->isPost
      && $model->load($this->request->post())
      && $model->save()) {
      return $this->redirect($this->request->get('to', ['ver', 'id' => $model->id]));
    }
    return $this->render('cambiar_contrasena', ['model' => $model]);
  }

  public function actionEliminar($id)
  {
    $model = Usuario::findOne($id);
    $model->delete();
    return $this->redirect($this->request->get('to', ['lista']));
  }

}
