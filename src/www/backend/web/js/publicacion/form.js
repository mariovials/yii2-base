$(function() {

  $('#publicacion-autor').autocompletadoMultiple({
    url: '/persona/buscar?q=',
  })

  $('#publicacion-editor').autocompletadoMultiple({
    url: '/persona/buscar?q=',
  })

  $('#publicacion-editorial').autocompletadoMultiple({
    url: '/editorial/buscar?q=',
  })

  $('#publicacion-idioma').autocompletadoMultiple({
    url: '/idioma/buscar?q=',
  })

});
