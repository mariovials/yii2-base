<?php

use yii\db\Migration;

class m230819_141401_usuario extends Migration
{
  public function safeUp()
  {
    $this->createTable('usuario', [
      'id' => $this->primaryKey(),
      'estado' => $this->smallInteger()->notNull()->defaultValue(1),

      'nombre' => $this->string(32)->notNull(),
      'apellido' => $this->string(32),

      'contrasena' => $this->string()->notNull(),
      'correo_electronico' => $this->string(254)->notNull()->unique(),

      'auth_key' => $this->string(32)->notNull(),

      'fecha_creacion' => $this->datetime()->notNull(),
      'fecha_edicion' => $this->datetime()->notNull(),
    ]);
  }

  public function safeDown()
  {
    $this->dropTable('usuario');
  }
}
