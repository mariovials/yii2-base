<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Orden;
use common\helpers\ArrayHelper;

/**
 * OrdenSearch represents the model behind the search form of `common\models\Orden`.
 */
class OrdenSearch extends Orden
{
  public $tipo_entrega = null;

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['id', 'estado', 'tipo_entrega'], 'integer'],
      [['observaciones'], 'safe'],
      [['fecha_creacion'], 'datetime', 'format' => 'yyyy-MM-dd'],
    ];
  }

  public function attributeLabels()
  {
    return ArrayHelper::merge(parent::attributeLabels(), [
      'tipo_entrega' => 'Tipo de entrega',
    ]);
  }

  public function scenarios()
  {
    return Model::scenarios();
  }

  public function search($params)
  {
    $query = Orden::find();
    $dataProvider = new ActiveDataProvider(['query' => $query]);
    $this->load($params);
    if (!$this->validate()) {
      $query->where('0=1');
    }
    $query->andFilterWhere([
      'id' => $this->id,
      'estado' => $this->estado,
      'fecha_creacion' => $this->fecha_creacion,
      'tipo_entrega' => $this->tipo_entrega,
    ]);
    $query->andFilterWhere(['ilike', 'observaciones', $this->observaciones]);
    return $dataProvider;
  }
}
