<?php
use yii\helpers\Url;
?>

<div class="ficha">
  <header>
    <div class="principal">
      <div class="icono">
        <i class="mdi mdi-image"></i>
      </div>
      <div class="titulo">
        <div class="nombre">
          Imágenes
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
          <div class="lista-archivos" id="examen-imagenes">
            <?php foreach ($model
              ->getExamenImagenes()
              ->orderBy('id')
              ->all() as $examenImagen): ?>
            <div class="item imagen">
              <?= $this->render('/archivo/_item', ['model' => $examenImagen->archivo]) ?>
              <div class="opciones">
                <div class="opcion">
                  <a class="btn btn-descargar"
                    href="<?= Url::to(['/resultado/descargar',
                    'id' => $examenImagen->id,
                    'to' => Url::current()]) ?>">
                    <i class="mdi mdi-download"></i>
                  </a>
                </div>
                <div class="opcion">
                  <a class="btn btn-eliminar"
                    href="<?= Url::to(['/examen-imagen/eliminar',
                    'id' => $examenImagen->id,
                    'to' => Url::current()]) ?>">
                    <i class="mdi mdi-delete"></i>
                  </a>
                </div>
              </div>
            </div>
            <?php endforeach ?>
            <a class="item imagen agregar" id="btn-agregar-imagen"
              href=<?= Url::to(['examen-imagen/agregar',
                'examen_id' => $model->id]) ?>>
              <div class="miniatura">
                <i class="mdi mdi-file-image-plus-outline"></i>
                AGREGAR IMAGEN
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>
