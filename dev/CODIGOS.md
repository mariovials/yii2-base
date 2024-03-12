
    $this->createIndex(
      'tablename-column1-column2-index',
      'tablename',
      ['column1', 'column2'],
      true); // unique

    // agrega clave foranea en tabla_actual.columna_actual hacia tabla_destino.columna_destino
    $this->addForeignKey (
      'fk-tabla_actual-columna_actual-tabla_destino-columna_destino',
      'tabla_actual',
      'columna_actual',
      'tabla_destino',
      'columna_destino',
      'RESTRICT', // si se borra tabla_destino
      'CASCADE');
