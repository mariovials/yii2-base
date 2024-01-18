window.addEventListener("pageshow", () => {

  $('.articulo .precio .cantidad > .mod.mas').on('click', function() {
    articulo = $(this).closest('.articulo')
    id = articulo.data('id')
    num = parseInt($(this).closest('.cantidad').find('.numero').text().trim());
    $(this).closest('.cantidad').find('.numero').html(num + 1)
    $.ajax({
      url: '/articulo/cambiar-cantidad',
      data: { id: id, mod: 1, },
      success: function(data) {
        window.location.reload()
      },
    })
  })

  $('.articulo .precio .cantidad > .mod.menos').on('click', function() {
    articulo = $(this).closest('.articulo')
    id = articulo.data('id')
    num = parseInt($(this).closest('.cantidad').find('.numero').text().trim());
    if (num > 1) {
      $(this).closest('.cantidad').find('.numero').html(num - 1)
      $.ajax({
        url: '/articulo/cambiar-cantidad',
        data: { id: id, mod: -1, },
        success: function(data) {
          window.location.reload()
        },
      })
    }
  })

})


// archivos venta
// PDFs, JPG, PNG
// ventas, frontend
//
// fotos
// PNG, JPG
// backend, frontend
//
