window.addEventListener("pageshow", () => {

  $.fn.autoResize = function() {
    let r = e => {
      e.style.height ='';
      e.style.height = e.scrollHeight + 4 +'px'
    };
    return this.each((i, e) => {
      r(e);
      $(e).bind('input', e => {
        r(e.target);
      })
    })
  };

  revisarInput = function(input) {
    console.log('revisando')
    input.closest('.form-group')
      .find('label')
      .toggleClass('activo', input.val() != '')
  }

  $('.form').each(function () {

    $(this).find('.form-group').not('.ql').each(function() {
      $(this).find('textarea').autoResize()
      $(this).find(`
        select,
        textarea,
        input[type="text"],
        input[type="password"],
        input[type="date"],
        input[type="email"],
        input[type="search"],
        input[type="tel"],
        input[type="number"]`).each(function() {
        revisarInput($(this))
        $(this).on('change', function() {
          revisarInput($(this))
        })
        $(this).on('focusout', function() {
          revisarInput($(this))
        })
        $(this).on('focusin', function() {
          $(this).closest('.form-group')
            .find('label')
            .addClass('activo')
        })
      })
    })

    $(this).find('.form-group.ql').each(function() {
      revisarInput($(this).find('input[type="hidden"]'))
      $(this).on('focusin', () => {
        $(this).find('label').addClass('activo')
      })
      $(this).on('focusout', () => {
        revisarInput($(this).find('input[type="hidden"]'))
      })
    })

  })
})
