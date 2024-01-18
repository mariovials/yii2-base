<?php
use common\widgets\ActiveForm;
use common\models\OrdenEstado;
use backend\widgets\ListView;
use yii\data\ActiveDataProvider;
?>

<div class="ficha">

  <header>
    <div class="principal">
      <div class="icono">
        <i class="mdi mdi-flask-outline"></i>
      </div>
      <div class="titulo">
        <div class="nombre">
          Exámenes
        </div>
        <div class="descripcion">
          <div class="chip">
            <?= $model->motivo ?>
          </div>
        </div>
      </div>
    </div>
  </header>

  <main>
    <div class="fila">
      <div class="campo grande">
        <div class="value">
          <?= ListView::widget([
            'options' => ['class' => 'lista compacta'],
            'layout' => '<div class="items">{items}</div>',
            'dataProvider' => new ActiveDataProvider([
              'query' => $model->getOrdenExamenes()->orderBy('id'),
              'sort' => false,
              'pagination' => false,
            ]),
            'viewParams' => [
              'attributes' => [
                'nombre',
                'no-link',
              ],
              'opciones' => [
                $model->estado > 1 && $model->estado < 100 ? 'fecha-estado' : null,
                $model->estado == OrdenEstado::MUESTRA  ? 'siguiente-estado' : null,
                $model->estado == OrdenEstado::ANALISIS ? 'siguiente-estado' : null,
              ],
            ],
            'itemView' => '/orden-examen/_lista',
          ]); ?>
        </div>
      </div>
    </div>
    <div class="fila">
      <div class="campo grande observaciones">
        <div class="label">
          <?= $model->getAttributeLabel('observaciones') ?>
        </div>
        <div class="value">
          <?php $form = ActiveForm::begin([
            'options' => [
              'class' => 'form',
              'autocomplete' => 'off',
            ],
            'action' => ['/orden/editar', 'id' => $model->id],
            'method' => 'post',
          ]); ?>
          <?= $form->field($model, 'observaciones')->textarea()->label(false) ?>
          <button type="submit"> Guardar </button>
          <?php ActiveForm::end(); ?>
          <?php
          $this->registerJs("
            $('#orden-observaciones').on('focus', function() {
              $(this).closest('.campo').addClass('activo');
            }).on('blur', function() {
              $(this).closest('.campo').removeClass('activo');
            })
          ");
          ?>
        </div>
      </div>
    </div>
  </main>

</div>

<style>
  .campo.observaciones {
    position: relative;
  }
  .campo.observaciones button {
    display: none;
    background: #263238;
    color: #EEE;
    padding: 0.7em 1.2em;
    border-radius: 0 0 0.7em 0.7em;
    right: 2em;
    bottom: -2.7em;
    position: absolute;
    border: none;
    box-shadow: 0 0.1em 0.6em -0.2em #000;
  }
  .campo.observaciones.activo button {
    display: block;
  }
  .form-group.textarea textarea {
    width: 100%;
    resize: none;
    border-radius: 0.5em;
    border-color: transparent;
    padding: 0.6em 0.4em;
    min-height: 6em;
  }
  .form-group.textarea textarea:focus,
  .form-group.textarea textarea:active, {
    outline: 3px solid #000;
    border-color: #263238;
  }
  .form-group.textarea textarea:hover {
    border-style: solid;
    border-color: #AAA;
    resize: vertical;
  }
</style>
