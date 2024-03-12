<?php
use common\models\Persona;
use common\models\Editor;
use backend\widgets\ListView;
use yii\data\ActiveDataProvider;

$this->title = 'Editores';
?>

<div class="autor indice">

  <?= $this->render('_indice', ['opciones' => [], 'link' => false]) ?>

  <div class="ficha lista">
    <main>
      <br>
      <?= ListView::widget([
        'dataProvider' => new ActiveDataProvider([
          'query' => Persona::find()->where(['id' => Editor::find()->select('persona_id')]),
          'sort' => [
            'attributes' => [
              'nombre',
              'editados' => [
                'default' => SORT_DESC,
              ],
            ],
            'defaultOrder' => [
              'nombre' => SORT_ASC,
            ]
          ],
          'pagination' => ['pageSize' => false],
        ]),
        'itemView' => '_lista',
        'viewParams' => [
          'attributes' => [
            'ediciones',
          ],
        ],
      ]); ?>
    </main>
  </div>

</div>
