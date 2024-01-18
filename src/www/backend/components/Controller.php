<?php
namespace backend\components;

use yii\filters\AccessControl;

/**
 *
 */
class Controller extends \yii\web\Controller
{
  public $defaultAction = 'indice';

  public function behaviors()
  {
    return [
      'access' => [
        'class' => AccessControl::class,
        'rules' => [
          [
            'allow' => true,
            'roles' => ['@'],
          ],
        ],
      ],
    ];
  }
}
