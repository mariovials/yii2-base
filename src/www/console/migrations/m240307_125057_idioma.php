<?php

use yii\db\Migration;
use yii\db\Query;
use common\helpers\StringHelper;
use console\components\Console;

/**
 * Class m240307_125057_idioma
 */
class m240307_125057_idioma extends Migration
{
  /**
   * {@inheritdoc}
   */
  public function safeUp()
  {
    $this->createTable('idioma', [
      'id' => $this->primaryKey(),
      'nombre' => $this->string(64)->notNull()->unique(),
      'slug' => $this->string(64)->notNull()->unique(),
      'publicados' => $this->integer()->defaultValue(1),
      'fecha_creacion' => $this->datetime(),
    ]);

    $this->createTable('en', [
      'id' => $this->primaryKey(),
      'publicacion_id' => $this->integer()->notNull(),
      'idioma_id' => $this->integer()->notNull(),
      'orden' => $this->integer()->notNull()->defaultValue(1),
    ]);
    // agrega clave foranea en en.publicacion_id hacia publicacion.id
    $this->addForeignKey (
      'fk-en-publicacion_id-publicacion-id',
      'en',
      'publicacion_id',
      'publicacion',
      'id',
      'CASCADE', // si se borra publicacion
      'CASCADE');
    // agrega clave foranea en en.idioma_id hacia idioma.id
    $this->addForeignKey (
      'fk-en-idioma_id-idioma-id',
      'en',
      'idioma_id',
      'idioma',
      'id',
      'RESTRICT', // si se borra idioma
      'CASCADE');

    foreach ((new Query)->from('publicacion')->all() as $publicacion) {
      $idiomas = array_filter(array_map('trim', explode(',', $publicacion['idioma'])));
      foreach ($idiomas as $i => $nombre) {
        if (!(new Query())
          ->from('idioma')
          ->where(['slug' => StringHelper::slugify($nombre)])
          ->exists()) {
          $this->insert('idioma', [
            'nombre' => $nombre,
            'slug' => StringHelper::slugify($nombre),
          ]);
        }
        $idioma = (new Query())
          ->from('idioma')
          ->where(['slug' => StringHelper::slugify($nombre)])
          ->one();
        if (!(new Query)->from('en')
          ->where([
            'publicacion_id' => $publicacion['id'],
            'idioma_id' => $idioma['id'],
          ])
          ->exists()) {
          $this->insert('en', [
            'publicacion_id' => $publicacion['id'],
            'idioma_id' => $idioma['id'],
            'orden' => ($i + 1),
          ]);
        }
      }
    }

    foreach ((new Query)->from('idioma')->all() as $idioma) {
      $this->update('idioma',
        ['publicados' => (new Query)->from('en')
          ->where(['idioma_id' => $idioma['id']])
          ->count()],
        ['id' => $idioma['id']]);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function safeDown()
  {
    $this->dropTable('en');
    $this->dropTable('idioma');
  }

}
