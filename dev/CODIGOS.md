    $this->createIndex(
      'table-column1-column2-index',
      'table',
      ['column1', 'column2'],
      true);

    // agrega clave foranea en tabla_original.columna_original
    // hacia tabla_destino.columna_destino
    $this->addForeignKey (
      'fk-tabla_original-columna_original-tabla_destino-columna_destino',
      'tabla_original',
      'columna_original',
      'tabla_destino',
      'columna_destino',
      'SET NULL', // si se borra tabla_destino
      'CASCADE');
