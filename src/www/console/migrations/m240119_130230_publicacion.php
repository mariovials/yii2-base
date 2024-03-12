<?php

use yii\db\Migration;

/**
 * Class m240119_130230_publicacion
 */
class m240119_130230_publicacion extends Migration
{
  /**
   * {@inheritdoc}
   */
  public function safeUp()
  {
    $this->createTable('publicacion', [
      'id' => $this->primaryKey(),

      'tipo' => $this->integer()->notNull()->defaultValue(1),

      'nombre' => $this->string(255),
      'autor' => $this->string(255),
      'editor' => $this->string(255),
      'editorial' => $this->string(255),
      'isbn' => $this->string(64),
      'idioma' => $this->string(255),

      'link' => $this->string(256),
      'descripcion' => $this->text(),

      'periodo' => $this->integer(),
      'mes' => $this->integer(),
      'dia' => $this->integer(),
      'orden' => $this->integer(),
      'disponible' => $this->boolean(),

      'archivo_id' => $this->integer(),

      'visible' => $this->boolean(),
      'visitas' => $this->integer(),

      'fecha_creacion' => $this->datetime(),
      'fecha_edicion' => $this->datetime(),

      'creado_por' => $this->integer(),
      'editado_por' => $this->integer(),

    ]);

    // agrega clave foranea en publicacion.archivo_id
    // hacia archivo.id
    $this->addForeignKey (
      'fk-publicacion-archivo_id-archivo-id',
      'publicacion',
      'archivo_id',
      'archivo',
      'id',
      'SET NULL', // si se borra archivo
      'CASCADE');

  }

  /**
   * {@inheritdoc}
   */
  public function safeDown()
  {
    $this->dropTable('publicacion');
  }
}
