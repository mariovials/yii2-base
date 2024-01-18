<?php

use yii\db\Migration;

/**
 * Class m230901_205009_configuracion
 */
class m230901_205009_configuracion extends Migration
{

  // 1 'integer' => 'Integer (Número entero)' ,
  // 2 'string' => 'String (Texto)',
  // 3 'boolean' => 'Boolean (Si/No)',
  // 4 'time' => 'Time (Hora)',

  public function safeUp()
  {
    $this->createTable('configuracion', [
      'id' => $this->primaryKey(),
      'nombre' => $this->string()->notNull(),
      'codigo' => $this->string(32)->notNull(),
      'tipo_php' => $this->string()->notNull(),
      'valor' => $this->string(),
      'descripcion' => $this->text(),
      'tipo' => $this->string(),
    ]);

    $this->createIndex(
      'configuracion-codigo-tipo_php-index',
      'configuracion',
      ['codigo', 'tipo_php'],
      false);

  }

  /**
   * {@inheritdoc}
   */
  public function safeDown()
  {
    $this->dropTable('configuracion');
  }
}
