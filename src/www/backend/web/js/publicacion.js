/**
 * Orden
 */
$(function() {

let btn = $('#btn-cambiar-portada')
let subiendo = 0

btn.on('click', function(e) {
  e.preventDefault()
  e.stopPropagation()

  url = $(this).attr('href')

  // crea el input
  var input = $(document.createElement('input'))
  input.attr("type", "file")
  input.attr("id", "input-agregar-receta")
  input.attr("name", "Publicacion[file]")

  // cuando cambia el value del input
  // agrega los items al form para enviarlos
  // y los envia
  input.on('change', function() {
    $(this).simpleUpload(url, {
      start: function(file) {
        console.log('start')
        subiendo++
      },
      progress: function(progress) {
        console.log('progress', progress)
      },
      success: function(data) {
        console.log(data)
      },
      error: function(error) {
        console.log(error)
        console.log(error.responseText)
      },
      complete: function() {
        console.log('complete')
        subiendo--
      },
      finish: function() {
        console.log('finish')
        if (subiendo == 0) {
        }
      },
    })
  })

  input.trigger('click')
})

})
