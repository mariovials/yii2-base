window.addEventListener("pageshow", () => {

  $('body').on('click', function(e) {
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

  $('#lista').on('click', '.item a', function() {
    $(this).attr('href')
    $.ajax({
      url: url,
      beforeSend: function() {
        console.log('beforeSend')
      },
      success: function(data) {
        console.log('success')
        console.log(data)
      },
      error: function() {
        console.log('error')
      },
      complete: function() {
        console.log('complete')
      },
    })
  })


})
