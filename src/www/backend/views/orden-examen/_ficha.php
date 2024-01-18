<?php
use yii\helpers\Url;
use common\models\OrdenEstado;
$estados = OrdenEstado::$estados;
?>
<div class="ficha" id="orden-examen" data-id="<?= $model->id ?>">
  <header>
    <div class="principal">
      <div class="icono">
        <i class="mdi mdi-flask"></i>
      </div>
      <div class="titulo">
        <div class="nombre">
          <?= $model->examen->nombre ?>
        </div>
        <div class="descripcion">
          <?= $model->examen->descripcion ?>
        </div>
      </div>
    </div>
  </header>
  <main>
    <div class="fila">
      <div class="campo grande">
        <div class="label">
        </div>
        <div class="value">
          <table id="muestras" class="center">
            <tbody>
              <tr>
                <td class="checkbox">
                  <label class="checkbox">
                    <input type="checkbox" data-estado="<?= OrdenEstado::TOMA ?>"
                      <?= $model->estado >= OrdenEstado::TOMA ? 'checked' : '' ?>>
                    <div class="box"> </div> <div class="label"> Muestras recogidas </div>
                  </label>
                </td>
                <td>
                  <?php
                  $ordenExamenEstado = $model->getEstados()
                    ->andWhere(['estado' => OrdenEstado::TOMA])
                    ->one();
                  if ($ordenExamenEstado) {
                    echo Yii::$app->formatter->asDatetime($ordenExamenEstado->fecha);
                  }
                  ?>
                </td>
              </tr>
              <tr>
                <td class="checkbox">
                  <label class="checkbox">
                    <input type="checkbox" data-estado="<?= OrdenEstado::MUESTRA ?>"
                      <?= $model->estado >= OrdenEstado::MUESTRA ? 'checked' : '' ?>>
                    <div class="box"> </div> <div class="label"> Muestras recibidas </div>
                  </label>
                </td>
                <td>
                  <?php
                  $ordenExamenEstado = $model->getEstados()
                    ->andWhere(['estado' => OrdenEstado::MUESTRA])
                    ->one();
                  if ($ordenExamenEstado) {
                    echo Yii::$app->formatter->asDatetime($ordenExamenEstado->fecha);
                  }
                  ?>
                </td>
              </tr>
              <tr>
                <td class="checkbox">
                  <label class="checkbox">
                    <input type="checkbox" data-estado="<?= OrdenEstado::ANALISIS ?>"
                      <?= $model->estado >= OrdenEstado::ANALISIS ? 'checked' : '' ?>>
                    <div class="box"> </div> <div class="label"> Análisis solicitado </div>
                  </label>
                </td>
                <td>
                  <?php
                  $ordenExamenEstado = $model->getEstados()
                    ->andWhere(['estado' => OrdenEstado::ANALISIS])
                    ->one();
                  if ($ordenExamenEstado) {
                    echo Yii::$app->formatter->asDatetime($ordenExamenEstado->fecha);
                  }
                  ?>
                </td>
              </tr>
              <tr>
                <td class="checkbox">
                  <label class="checkbox">
                    <input type="checkbox" data-estado="<?= OrdenEstado::RESULTADO ?>"
                      <?= $model->estado >= OrdenEstado::RESULTADO ? 'checked' : '' ?>>
                    <div class="box"> </div> <div class="label"> Resultados recibidos </div>
                  </label>
                </td>
                <td>
                  <?php
                  $ordenExamenEstado = $model->getEstados()
                    ->andWhere(['estado' => OrdenEstado::RESULTADO])
                    ->one();
                  if ($ordenExamenEstado) {
                    echo Yii::$app->formatter->asDatetime($ordenExamenEstado->fecha);
                  }
                  ?>
                </td>
              </tr>
              <tr>
                <td class="checkbox">
                  <label class="checkbox">
                    <input type="checkbox" data-estado="<?= OrdenEstado::ENVIADO ?>"
                      <?= $model->estado >= OrdenEstado::ENVIADO ? 'checked' : '' ?>>
                    <div class="box"> </div> <div class="label"> Resultados enviados </div>
                  </label>
                </td>
                <td>
                  <?php
                  $ordenExamenEstado = $model->getEstados()
                    ->andWhere(['estado' => OrdenEstado::ENVIADO])
                    ->one();
                  if ($ordenExamenEstado) {
                    echo Yii::$app->formatter->asDatetime($ordenExamenEstado->fecha);
                  }
                  ?>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="fila">
      <div class="campo">
        <div class="label">
          Observaciones
        </div>
        <div class="value">
          <?= nl2br($model->observaciones) ?>
        </div>
      </div>
    </div>
  </main>
  <footer>
    <div class="opciones">
      <div class="opcion">
        <a class="btn"href="<?= Url::to(["editar",
          'id' => $model->id,
          'from' => Url::current()]) ?>">
          <span class="mdi mdi-pencil"></span>
          Editar
        </a>
      </div>
    </div>
  </footer>
</div>

<style>
#muestras {
  font-size: 0.9rem;
  width: inherit;
}
#muestras tr td, #muestras tr th {
  padding: 0.2em;
}
#muestras thead tr th i.mdi {
  font-size: 1.9rem;
}
#muestras tbody tr td.checkbox i.mdi {
  color: #444;
  vertical-align: middle;
}
#muestras tbody tr td.checkbox {
  text-align: left;
}
#muestras tbody tr td.checkbox label.checkbox {
  font-size: 1rem;
  padding: 0.3em 0.6em 0.5em;
  display: block;
  border-radius: 0.5em;
}
#muestras tbody tr td.checkbox label.checkbox input + span {
  padding: 0 0 0 1.7em;
  margin: auto;
}
#muestras tbody tr td.checkbox label.checkbox span {
  margin-top: 0.3em;
  user-select: none;
  font-weight: 500;
}
#muestras tbody tr td.checkbox.hover {
  background: #FFFFFF;
}
#muestras tbody tr td.checkbox label.checkbox:hover {
  background: #FFFFFF;
  cursor: pointer;
}
</style>
