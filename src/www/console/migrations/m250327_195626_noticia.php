<?php

use console\components\Migration;
use console\components\Console;

class m250327_195626_noticia extends Migration
{
  public function safeUp()
  {
    $this->createTable('noticia', [
      'id' => $this->primaryKey(),

      'antetitulo' => $this->string(256)->null(),
      'titulo' => $this->string(256)->notNull(),
      'subtitulo' => $this->string(512)->null(),
      'entrada' => $this->text()->null(),
      'cuerpo' => $this->text()->null(),
      'fecha' => $this->date()->null(),

      'slug' => $this->string(2048)->notNull()->unique(),
      'visitas' => $this->integer()->defaultValue(1),

      'creado_por' => $this->integer(),
      'fecha_creacion' => $this->dateTime(),
      'editado_por' => $this->integer(),
      'fecha_edicion' => $this->dateTime(),
    ]);
  }

  public function safeDown()
  {
    $this->dropTable('noticia');
  }
}
