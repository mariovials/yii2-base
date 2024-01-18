/**
 * Orden
 */
$(function() {

$('#muestras td.checkbox').on("mouseenter", function() {
  if ($(this).find('input').is(':checked')) {
    $(this).closest('table').find('tr')
      .slice(
        $(this).closest('tr').index(),
        $(this).closest('table').find('tr').length)
      .filter(function() {
        return $(this).find('input').is(':checked')
      })
      .find('td.checkbox')
      .addClass('hover')
      .css('background', '#FFEEEE')
    $(this).find('label.checkbox')
      .css('background', '#FFCDD2')
  } else {
    $(this).closest('table').find('tr')
      .slice(0, $(this).closest('tr').index() + 1)
      .filter(function() {
        return $(this).find('input').is(':not(:checked)')
      })
      .find('td.checkbox')
      .addClass('hover')
      .css('background', '#F1F8E9')
    $(this).find('label.checkbox')
      .css('background', '#DCEDC8')
  }
}).on("mouseleave", function() {
  $('#muestras td')
    .removeClass('hover')
    .css('background', '')
  $('#muestras label.checkbox')
    .css('background', '')
})
$('#muestras .checkbox input').on('change', function() {
  id = $('#orden-examen').data('id')
  estado = $(this).data('estado')
  if ($(this).is(':checked')) {
    $(this).closest('table').find('tr')
      .slice(0, $(this).closest('tr').index())
      .find('input:not(:checked)')
      .prop('checked', true)
  } else {
    if (estado == 1) {
      estado = '';
    } else {
      estado = parseInt(estado) - 1
    }
    $(this).closest('table').find('tr')
      .slice(
        $(this).closest('tr').index(),
        $(this).closest('table').find('tr').length)
      .find('input:checked')
      .prop('checked', false)
  }
  $.get(`/orden-examen/${id}/cambiar-estado?estado=${estado}`, function(data) {
    location.reload()
  })
  $(this).closest('td')
    .trigger('mouseleave')
    .trigger('mouseenter');
})

})






