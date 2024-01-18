/**
 * Orden
 */
$(function() {

$('.btn-alternar-visibilidad').on('click', function(e) {
  e.preventDefault()
  $('#fichas-telemedicina').slideToggle(200)
  $(this).find('span').toggle()
  $.get($(this).attr('href'))
  $(this).toggleClass('btn')
  $(this).toggleClass('btn-flat')
})

/**
 * Subir receta
 */
let lista = $('.recetas')
let items = lista.find('.receta')

btn = $('#btn-agregar-receta')
let subiendo = 0

btn.on('click', function(e) {
  e.preventDefault()
  e.stopPropagation()

  url = $(this).attr('href')

  // crea el input
  var input = $(document.createElement('input'))
  input.attr("type", "file")
  input.attr("id", "input-agregar-receta")
  input.attr("name", "Receta[documento]")
  input.attr("multiple", "multiple")

  // cuando cambia el value del input
  // agrega los items al form para enviarlos
  // y los envia
  input.on('change', function() {
    $(this).simpleUpload(url, {
      start: function(file) {
        subiendo++
        this.item = $(`
          <div class="item receta">
            <div class="informacion">
              <div class="nombre"> ${this.upload.file.name} </div>
            </div>
            <div class="miniatura">Subiendo...</div>
          </div>`)
        btn.before(this.item)
      },
      progress: function(progress) {
          console.log(progress)
      },
      success: function(data) {
        this.item.find('miniatura').html('Listo!')
      },
      error: function(error) {
        console.log(error)
      },
      complete: function() {
        subiendo--
      },
      finish: function() {
        if (subiendo == 0) {
          window.location.reload()
        }
      },
    })
  })

  input.trigger('click')
})

lista.on('click', '.item .opcion .btn-eliminar', function(e) {
  e.preventDefault()
  item = $(this).closest('.item')
  $.get($(this).attr('href'), function() {
    item.remove()
    location.reload()
  })
})

$('#telemedicina-observaciones').on('change', function() {
  $(this).closest('form').submit()
})

})
