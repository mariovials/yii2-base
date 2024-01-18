/**
 * Menú de usuario
 */
$('#botones-usuario > li').on('click', function(e) {
  $(this).toggleClass('activo');
});

/**
 * Click
 */
$('#pagina').on('click', function(e) {
  if ($(e.target).closest('#botones-usuario').length === 0) {
    $('#botones-usuario > li').removeClass('activo');
  }
});

/**
 * Ficha
 */
$('#pagina').on('click', '.ficha.ocultable > header', function(e) {
  $(this).closest('.ficha').toggleClass('oculta');
});

/**
 * Lista
 */
$('.ficha .opcion .btn-filtro').on('click', function(e) {
  e.preventDefault()
  $(this).closest('.ficha').find('form.form.filtro').slideToggle(200)
  $(this).toggleClass('btn').toggleClass('btn-flat')
})
