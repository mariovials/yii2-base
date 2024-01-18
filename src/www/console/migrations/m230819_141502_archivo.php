<?php

use yii\db\Migration;

/**
 * Class m230819_141502_archivo
 */
class m230819_141502_archivo extends Migration
{
  /**
   * {@inheritdoc}
   */
  public function safeUp()
  {
    $this->createTable('archivo', [
      'id' => $this->primaryKey(),
      'tipo' => $this->smallInteger(),

      'nombre' => $this->string(255),

      'mime_type' => $this->string(128),
      'extension' => $this->string(5),
      'size' => $this->integer(),
      'basename' => $this->string(255),
      'filename' => $this->string(255),

      'ruta' => $this->string(255),
      'ruta_web' => $this->string(255),
      'ruta_min' => $this->string(255),

      'fecha_creacion' => $this->datetime()->notNull()->defaultExpression('NOW()'),
      'fecha_edicion' => $this->datetime()->notNull()->defaultExpression('NOW()'),
    ]);
  }

  /**
   * {@inheritdoc}
   */
  public function safeDown()
  {
    $this->dropTable('archivo');
  }
}
