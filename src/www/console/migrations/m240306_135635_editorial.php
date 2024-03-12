<?php

use yii\db\Migration;
use common\models\Publicacion;

/**
 * Class m240306_135635_editorial
 */
class m240306_135635_editorial extends Migration
{
  /**
   * {@inheritdoc}
   */
  public function safeUp()
  {
    $this->createTable('editorial', [
      'id' => $this->primaryKey(),
      'nombre' => $this->string(64)->notNull()->unique(),
      'slug' => $this->string(64)->notNull()->unique(),
      'publicados' => $this->integer(),

      'fecha_creacion' => $this->datetime(),
      'fecha_edicion' => $this->datetime(),
    ]);

    $this->createTable('edita', [
      'id' => $this->primaryKey(),
      'editorial_id' => $this->integer()->notNull(),
      'publicacion_id' => $this->integer()->notNull(),
      'orden' => $this->integer()->defaultValue(1),
    ]);
    // agrega clave foranea en edita.editorial_id hacia editorial.id
    $this->addForeignKey (
      'fk-edita-editorial_id-editorial-id',
      'edita',
      'editorial_id',
      'editorial',
      'id',
      'CASCADE', // si se borra editorial
      'CASCADE');
    // agrega clave foranea en edita.publicacion_id hacia publicacion.id
    $this->addForeignKey (
      'fk-edita-publicacion_id-publicacion-id',
      'edita',
      'publicacion_id',
      'publicacion',
      'id',
      'CASCADE', // si se borra publicacion
      'CASCADE');
    $this->createIndex(
      'edita-editorial_id-publicacion_id-index',
      'edita',
      ['editorial_id', 'publicacion_id'],
      true);

    foreach (Publicacion::find()->all() as $publicacion) {
      $publicacion->markAttributeDirty('editorial');
      $publicacion->save();
    }
  }

  /**
   * {@inheritdoc}
   */
  public function safeDown()
  {
    $this->dropTable('edita');
    $this->dropTable('editorial');
  }
}
