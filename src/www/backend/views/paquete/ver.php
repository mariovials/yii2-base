<?php
use backend\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use common\helpers\Html;

$this->title = $model->nombre;
?>

<div class="paquete ver">

  <?= $this->render('_indice', ['model' => $model]); ?>
  <?= $this->render('_ficha', [
    'model' => $model,
    'opciones' => [
      'editar',
      'eliminar',
    ],
  ]); ?>

  <div class="ficha">
    <header>
    <div class="principal">
      <div class="icono"> <span class="mdi mdi-flask-outline"></span> </div>
      <div class="titulo">
        <div class="nombre"> Exámenes </div>
        <?php if (!$model->getPaqueteExamenes()->count()): ?>
        <div class="descripcion" style="color: red">
          Debe agregar los exámenes
        </div>
        <?php endif ?>
      </div>
    </div>

  </header>
    <main>
      <br>
      <?= ListView::widget([
        'dataProvider' => new ActiveDataProvider([
          'query' => $model->getPaqueteExamenes(),
          'sort' => ['attributes' => ['nombre']],
          'pagination' => false,
        ]),
        'itemView' => '/paquete-examen/_lista',
        'viewParams' => [
          'attributes' => [],
          'opciones' => [],
        ],
      ]); ?>
    </main>
    <footer>
      <div class="opciones">
        <div class="opcion">
          <a href="<?= Url::to(['/paquete-examen/agregar',
            'paquete_id' => $model->id,
            'from' => Url::current()]) ?>"
            class="btn">
            <span class="mdi mdi-plus-thick"></span>
            Añadir exámen
          </a>
        </div>
      </div>
    </footer>
  </div>

</div>

<?php
$this->params['menu'][] = Html::a(
  $model->en_portada ?
    '<i class="mdi mdi-star-outline"></i> Quitar de portada'
    : '<i class="mdi mdi-star"></i> Agregar a portada',
  ['/paquete/editar', 'id' => $model->id, 'from' => Url::current()], [
    'class' => 'btn',
    'data' => [
      'confirm' => '¿Está seguro?',
      'method' => 'POST',
      'params' => [
        'Paquete[en_portada]' => $model->en_portada ? '0' : '1',
      ],
    ],
  ]);
