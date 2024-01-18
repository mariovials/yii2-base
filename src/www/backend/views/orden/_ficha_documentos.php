<?php
use yii\helpers\Url;
use common\models\OrdenEstado;
?>

<div class="ficha">
  <header>
    <div class="principal">
      <div class="icono">
        <i class="mdi mdi-file-document-multiple"></i>
      </div>
      <div class="titulo">
        <div class="nombre">
          Resultados
        </div>
        <div class="descripcion">
          Documentos
          <?php if ($model->estado > OrdenEstado::ENVIADO): ?>
            enviados
          <?php else: ?>
            que serán enviador
          <?php endif ?>
          por correo al responsable
        </div>
      </div>
    </div>
  </header>
  <main>
    <div class="fila">
      <div class="campo grande lista">
        <div class="label">
        </div>
        <div class="value">
          <div class="documentos lista-archivos" id="resultados">
            <?php foreach ($model->getResultados()
              ->orderBy('orden, id')
              ->all() as $resultado): ?>
            <div class="item documento">
              <?= $this->render('/archivo/_item', ['model' => $resultado->archivo]) ?>
              <div class="opciones">
                <div class="opcion">
                  <a class="btn btn-descargar"
                    href="<?= Url::to(['/resultado/descargar',
                    'id' => $resultado->id,
                    'to' => Url::current()]) ?>">
                    <i class="mdi mdi-download"></i>
                  </a>
                </div>
                <div class="opcion">
                  <a class="btn btn-eliminar"
                    href="<?= Url::to(['/resultado/eliminar',
                    'id' => $resultado->id,
                    'to' => Url::current()]) ?>">
                    <i class="mdi mdi-delete"></i>
                  </a>
                </div>
              </div>
            </div>
            <?php endforeach ?>
            <?php
            $hayResultados = $model->getOrdenExamenes()
              ->where(['estado' => OrdenEstado::RESULTADO])
              ->exists();
            ?>
            <?php if ($hayResultados): ?>
            <a class="item documento agregar" id="btn-agregar-documento"
              href=<?= Url::to(['resultado/agregar',
              'orden_id' => $model->id]) ?>>
              <div class="miniatura">
                <i class="mdi mdi-file-document-plus-outline"></i>
                AGREGAR DOCUMENTO
              </div>
            </a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>

<style>
  .documentos .documento {
    position: relative;
    margin: 0 0.5rem 0.5rem 0;
    width: 13rem;
    height: 10rem;
  }
  .documentos .documento img {
    max-width: 100%;
    max-height: 100%;
    border: 1px solid #CCCCCC;
  }
  .documentos .documento:hover .btn-eliminar {
  }
  .documentos .documento .btn-eliminar:hover {
    cursor: pointer;
  }
  .documentos .documento .btn-eliminar i.mdi {
    font-size: 1.1rem;
  }
</style>
