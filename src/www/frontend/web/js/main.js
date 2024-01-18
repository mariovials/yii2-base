window.addEventListener("pageshow", () => {

  $('body').on('click', function(e) {
    if ($(e.target).closest('.desplegable').length === 0) {
      $('.desplegable').removeClass('activo');
    }
    if ($(e.target).closest('#menu').length === 0
      && $('#menu').hasClass('activo')) {
      $('#menu').slideUp()
    }
  })

  $('#btn-menu').on('click', () => {
    $('#menu').slideToggle(200, () => {
      $('#menu').toggleClass('activo')
    })
  })


  $.ajax({
    url: '/articulo/cantidad',
    success: function(data) {
      $('#btn-carro').find('.contador').html(data)
      if (parseInt(data) > 0) {
        $('#btn-carro')
          .addClass('activo')
          .append(`<span class="contador"> ${data} </span>`)
      } else {
        $('#btn-carro')
          .removeClass('activo')
          .find('.contador')
          .remove()
      }
    },
  })

  $('.desplegable').on('click', function(e) {
    $(this).toggleClass('activo')
    if (e.target.tagName == 'LI') {
      $(this).find('> div').html($(e.target).html())
    }
  })

})
