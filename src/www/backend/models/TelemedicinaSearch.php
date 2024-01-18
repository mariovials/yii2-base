<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Telemedicina;
use common\helpers\ArrayHelper;

/**
 * TelemedicinaSearch represents the model behind the search form of `common\models\Telemedicina`.
 */
class TelemedicinaSearch extends Telemedicina
{
  public $tipo_entrega = null;

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['id', 'estado'], 'integer'],
      [['fecha_creacion'], 'datetime', 'format' => 'yyyy-MM-dd'],
    ];
  }

  public function attributeLabels()
  {
    return ArrayHelper::merge(parent::attributeLabels(), [
    ]);
  }

  public function beforeValidate()
  {
    return Model::beforeValidate();
  }

  /**
   * {@inheritdoc}
   */
  public function scenarios()
  {
    return Model::scenarios();
  }

  /**
   * Creates data provider instance with search query applied
   *
   * @param array $params
   *
   * @return ActiveDataProvider
   */
  public function search($params)
  {
    $query = TelemedicinaSearch::find();
    $dataProvider = new ActiveDataProvider(['query' => $query]);
    $this->load($params);
    if (!$this->validate()) {
      var_dump($this->errors);
      die();
      $query->where('0=1');
    } else {
    }
    $query->andFilterWhere([
      'id' => $this->id,
      'estado' => $this->estado,
      'fecha_creacion' => $this->fecha_creacion,
    ]);
    return $dataProvider;
  }
}
