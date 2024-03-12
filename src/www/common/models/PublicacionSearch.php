<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Publicacion;

/**
 * PublicacionSearch represents the model behind the search form of `common\models\Publicacion`.
 */
class PublicacionSearch extends Publicacion
{

  public function rules()
  {
    return [
      [['id', 'tipo', 'periodo', 'mes', 'dia', 'orden', 'creado_por', 'editado_por'], 'integer'],
      [['autor', 'editores', 'editorial', 'isbn', 'idioma', 'link', 'descripcion', 'fecha_creacion', 'fecha_edicion'], 'safe'],
      [['disponible', 'visible'], 'boolean'],
    ];
  }


  public function scenarios()
  {
    // bypass scenarios() implementation in the parent class
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
    $query = Publicacion::find();

    // add conditions that should always apply here

    $dataProvider = new ActiveDataProvider([
      'query' => $query,
    ]);

    $this->load($params);

    if (!$this->validate()) {
      // uncomment the following line if you do not want to return any records when validation fails
      // $query->where('0=1');
      return $dataProvider;
    }

    // grid filtering conditions
    $query->andFilterWhere([
      'id' => $this->id,
      'tipo' => $this->tipo,
      'periodo' => $this->periodo,
      'mes' => $this->mes,
      'dia' => $this->dia,
      'orden' => $this->orden,
      'disponible' => $this->disponible,
      'visible' => $this->visible,
      'fecha_creacion' => $this->fecha_creacion,
      'fecha_edicion' => $this->fecha_edicion,
      'creado_por' => $this->creado_por,
      'editado_por' => $this->editado_por,
    ]);

    $query->andFilterWhere(['ilike', 'autor', $this->autor])
      ->andFilterWhere(['ilike', 'editores', $this->editores])
      ->andFilterWhere(['ilike', 'editorial', $this->editorial])
      ->andFilterWhere(['ilike', 'isbn', $this->isbn])
      ->andFilterWhere(['ilike', 'idioma', $this->idioma])
      ->andFilterWhere(['ilike', 'link', $this->link])
      ->andFilterWhere(['ilike', 'descripcion', $this->descripcion]);

    return $dataProvider;
  }
}
