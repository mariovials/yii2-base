<?php
use yii\helpers\Url;
use common\models\TelemedicinaEstado;
?>

<div class="ficha">
  <header>
    <div class="principal">
      <div class="icono">
        <i class="mdi mdi-file-sign"></i>
      </div>
      <div class="titulo">
        <div class="nombre">
          Recetas
        </div>
        <div class="descripcion">
          Documentos
          <?php if ($model->estado > TelemedicinaEstado::RESPONDIDA): ?>
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
          <div class="recetas lista-archivos" id="recetas">
            <?php foreach ($model->getRecetas()
              ->orderBy('orden, id')
              ->all() as $receta): ?>
            <div class="item receta">
              <?= $this->render('/archivo/_item', ['model' => $receta->archivo]) ?>
              <div class="opciones">
                <div class="opcion">
                  <a class="btn btn-descargar"
                    href="<?= Url::to(['/receta/descargar',
                    'id' => $receta->id,
                    'to' => Url::current()]) ?>">
                    <i class="mdi mdi-download"></i>
                  </a>
                </div>
                <div class="opcion">
                  <a class="btn btn-eliminar"
                    href="<?= Url::to(['/receta/eliminar',
                    'id' => $receta->id,
                    'to' => Url::current()]) ?>">
                    <i class="mdi mdi-delete"></i>
                  </a>
                </div>
              </div>
            </div>
            <?php endforeach ?>
            <a class="item receta agregar" id="btn-agregar-receta"
              href=<?= Url::to(['receta/agregar',
              'telemedicina_id' => $model->id]) ?>>
              <div class="miniatura">
                <i class="mdi mdi-file-document-plus-outline"></i>
                AGREGAR RECETA
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>

<style>
  .recetas .receta {
    position: relative;
    margin: 0 0.5rem 0.5rem 0;
    width: 13rem;
    height: 10rem;
  }
  .recetas .receta img {
    max-width: 100%;
    max-height: 100%;
    border: 1px solid #CCCCCC;
  }
  .recetas .receta:hover .btn-eliminar {
  }
  .recetas .receta .btn-eliminar:hover {
    cursor: pointer;
  }
  .recetas .receta .btn-eliminar i.mdi {
    font-size: 1.1rem;
  }
</style>
