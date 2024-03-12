<?php

use yii\db\Migration;
use common\models\Publicacion;
use common\models\PublicacionAutor;
use common\models\Autor;
use common\models\Persona;

/**
 * Class m240201_142622_autor
 */
class m240201_142622_autor extends Migration
{
  /**
   * {@inheritdoc}
   */
  public function safeUp()
  {
    $this->addColumn('publicacion', 'slug', $this->string(256));
    $this->addColumn('publicacion', 'issn', $this->string(64));

    $this->renameColumn('publicacion', 'editores', 'editor');

    $this->createTable('persona', [
      'id' => $this->primaryKey(),
      'nombre' => $this->string(256)->notNull()->unique(),
      'slug' => $this->string(256)->notNull()->unique(),
      'publicados' => $this->integer()->notNull()->defaultValue(0),
      'editados' => $this->integer()->notNull()->defaultValue(0),
      'fecha_creacion' => $this->datetime()->notNull(),
      'fecha_edicion' => $this->datetime(),
    ]);

    $this->createTable('autor', [
      'id' => $this->primaryKey(),
      'persona_id' => $this->integer()->notNull(),
      'publicacion_id' => $this->integer()->notNull(),
      'orden' => $this->integer()->defaultValue(1),
      'fecha_creacion' => $this->datetime()->notNull(),
    ]);
    // agrega clave foranea en autor.persona_id hacia persona.id
    $this->addForeignKey (
      'fk-autor-persona_id-persona-id',
      'autor',
      'persona_id',
      'persona',
      'id',
      'CASCADE', // si se borra persona
      'CASCADE');
    // agrega clave foranea en autor.publicacion_id hacia publicacion.id
    $this->addForeignKey (
      'fk-autor-publicacion_id-publicacion-id',
      'autor',
      'publicacion_id',
      'publicacion',
      'id',
      'CASCADE', // si se borra publicacion
      'CASCADE');
    $this->createIndex(
      'autor-persona_id-publicacion_id-index',
      'autor',
      ['persona_id', 'publicacion_id'],
      true);

    $this->createTable('editor', [
      'id' => $this->primaryKey(),
      'persona_id' => $this->integer()->notNull(),
      'publicacion_id' => $this->integer()->notNull(),
      'orden' => $this->integer()->defaultValue(1),
      'fecha_creacion' => $this->datetime()->notNull(),
    ]);
    // agrega clave foranea en editor.persona_id hacia persona.id
    $this->addForeignKey (
      'fk-editor-persona_id-persona-id',
      'editor',
      'persona_id',
      'persona',
      'id',
      'CASCADE', // si se borra persona
      'CASCADE');
    // agrega clave foranea en editor.publicacion_id hacia publicacion.id
    $this->addForeignKey (
      'fk-editor-publicacion_id-publicacion-id',
      'editor',
      'publicacion_id',
      'publicacion',
      'id',
      'CASCADE', // si se borra publicacion
      'CASCADE');
    $this->createIndex(
      'editor-persona_id-publicacion_id-index',
      'editor',
      ['persona_id', 'publicacion_id'],
      true);

    foreach (Publicacion::find()->orderBy('nombre')->all() as $publicacion) {
      $publicacion->markAttributeDirty('nombre'); // slug
      $publicacion->markAttributeDirty('autor');
      $publicacion->markAttributeDirty('editor');
      $publicacion->save();
    }

    foreach (Persona::find()->all() as $persona) {
      $persona->updateAttributes([
        'editados' => $persona->getEditores()->count(),
        'publicados' => $persona->getAutores()->count(),
      ]);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function safeDown()
  {
    $this->dropTable('autor');
    $this->dropTable('editor');
    $this->dropTable('persona');
    $this->renameColumn('publicacion', 'editor', 'editores');
    $this->dropColumn('publicacion', 'slug');
    $this->dropColumn('publicacion', 'issn');
  }
}
