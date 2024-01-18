// 167623794

window.addEventListener("pageshow", () => {

  /**
   * Variables
   */

  form = $('#telemedicina-form')
  puedePagar = false
  haCambiado = null
  cliente_id = null

  /**
   * Funciones
   */

  marcarComo = function(fieldset, clase) {
    fieldset.removeClass('activo error pendiente listo').addClass(clase)
  }

  siguienteParte = function(parte) {
    parte.find('main').slideUp(400, function() {
      marcarComo(parte, 'listo')
    })
    marcarComo(parte.next(), 'activo')
    parte.next().find('main').slideDown()
    parte.next().find('header .descripcion').slideDown()
    parte.find('header .descripcion').slideUp()
  }

  irAParteAnterior = function(parte) {
    parte.find('main').slideUp()
    parte.prev().find('main').slideDown()
    parte.prev().find('header .descripcion').slideDown()
    parte.find('header .descripcion').slideUp()
  }

  $('.fieldset header').on('click', function() {
    if (puedePagar) {
      fieldset = $(this).closest('.fieldset')
      if (!fieldset.find('main').is(':visible')) {
        $('.fieldset main').slideUp()
        fieldset.find('main').slideDown(400)
      }
    }
  })

  /**
   * Manejo de información visual
   */

  $('#btn-validar-rut').on('click', function() {
    form.yiiActiveForm('validateAttribute', 'cliente-rut');
  })

  $('#btn-cambiar-rut').on('click', function() {
    $('#cliente-rut').val('').focus()
    $('#btn-cambiar-rut').hide()
    $('#btn-validar-rut').show()
    $('.field-cliente-rut').removeClass('readonly')
    $('.field-cliente-rut :input').removeAttr('readonly')
    $('.filas.responsable').slideUp()
  })

  $('.btn-ir-a-parte-anterior').on('click', function() {
    irAParteAnterior($(this).closest('.fieldset'))
  })

  $('.btn-ir-a-parte-siguiente').on('click', function() {
    parte = $(this).closest('.fieldset')
    validarParte(parte)
    if (!parte.find('.has-error').length) {
      siguienteParte(parte)
    }
  })

  $('#telemedicina-acepta_todo').on('change', function() {
    if ($(this).is(':checked')) {
      $('.campo.aceptar label :input').prop('checked', true)
    } else {
      $('.campo.aceptar label :input').prop('checked', false)
    }
    validarParte($('#terminos'))
  })

  // acepta términos
  $('.campo.aceptar label :input').on('change', function() {
    if ($('.campo.aceptar label :input:checked').length == 3) {
      $('#telemedicina-acepta_todo').prop('checked', true)
    } else {
      $('#telemedicina-acepta_todo').prop('checked', false)
    }
    validarParte($('#terminos'))
  })

  $('#btn-ir-a-pagar').on('click', function() {
    if (puedePagar) {
      $('#btn-pagar').removeAttr('disabled')
    }
  })

  validarParte = function (parte) {
    $(form.data('yiiActiveForm').attributes).each(function(i, attr) {
      if ($(parte).find(attr.input + ':not(:disabled)').length) {
        attr.status = 3 // pending validation
      } else {
        attr.status = 0
      }
    })
    form.yiiActiveForm('validate')
  }

  /**
   * Envío de datos
   */

  /**
   * Manejo de datos (autocompletado)
   */

  $('#telemedicina-paciente_id').on('change', function () {
    paciente_id = $(this).val()
    $.get('/paciente/buscar?id=' + paciente_id, function(data) {
      $.each(data, function(attr, value) {
        input = $(':input#paciente-' + attr)
        if (input.length) {
          input.val(value).trigger('change')
        }
        $('#paciente-' + attr + '[role="radiogroup"]')
          .find('input[value="' + value + '"]')
          .prop('checked', true)
        form.yiiActiveForm('validateAttribute', 'paciente-' + attr)
      })
    })

  })

  cambiarCliente = function(id) {
    $.get('/compra/' + cliente_id + '/cambiar-cliente?cliente_id=' + id)
  }

  /**
   * Validación de datos
   */

  // valida comuna
  form.on('beforeValidateAttribute', function(e, attribute, messages) {
    if (attribute.id == 'cliente-comuna') {
      value = $(`#${attribute.id}`).val()
      if (!$(`#${attribute.id}-list option[value="${value}"]`).length) {
        messages.push(`Comuna '${value}' no existe`)
      }
    }
  })

  form.on('keyup', ':input', function() {
    $('#btn-pagar').attr('disabled', true)
  })

  // validar cliente.rut
  form.on('afterValidateAttribute', function(event, attribute, messages) {
    if (attribute.id == 'cliente-rut') {
      if (messages.length) {
        // error de rut
        $('#btn-siguiente-1').attr('disabled', true)
        $('.filas.responsable').find('.form-group').addClass('disabled')
        $('.filas.responsable :input').prop('disabled', true)
        $('.field-cliente-rut').removeClass('readonly')
        $('.field-cliente-rut :input').removeAttr('readonly')
        $('#btn-cambiar-rut').hide()
        $('#btn-validar-rut').show()
      } else {
        // rut ok
        $('.field-cliente-rut').addClass('readonly')
        $('.field-cliente-rut :input').attr('readonly', true)
        $('#btn-siguiente-1').removeAttr('disabled')
        $('.filas.responsable').find('.form-group').removeClass('disabled')
        $('.filas.responsable :input').prop('disabled', false)
        $('.filas.responsable').slideDown()
        $('#btn-cambiar-rut').show()
        $('#btn-validar-rut').hide()
        $.get('/cliente/buscar-por-rut?rut=' + attribute.value, function(data) {
          if (cliente_id != null
            && data.cliente != undefined
            && data.cliente.id != cliente_id) {

            // cliente
            cambiarCliente(data.cliente.id)
            cliente_id = data.cliente.id
            $.each(data.cliente, function(attr, value) {
              input = $(':input#cliente-' + attr)
              if (input.length) {
                input.val(value)
                if (value) {
                  $('#cliente-' + attr).trigger('change')
                }
              }
              $('#cliente-' + attr + '[role="radiogroup"]')
                .find('input[value="' + value + '"]')
                .prop('checked', true)
                .trigger('change')
            })

            // paciente
            options = ''
            cantidad = 0
            $.each(data.pacientes, function(i, paciente) {
              if (i == 0) {
                paciente_id = paciente.id
                selected = 'selected'
              }
              options += `<option ${selected} value="${paciente.id}">
                ${paciente.nombre}
              </option>`
            })
            $('#telemedicina-paciente_id').find('option[value!="-1"]').remove()
            $('#telemedicina-paciente_id').prepend(options)
            $('#telemedicina-paciente_id').trigger('change')
            $('#paciente .filas.selector').slideDown()
          }
        })
      }
    }
  })

  // actualizar fieldset
  form.on('afterValidateAttribute', function(e, attribute, messages) {
    fieldset = $(attribute.input).closest('.fieldset')
    if (messages.length) {
      marcarComo(fieldset, 'error')
    }
    if (fieldset.find('.has-error').length == 0) {
      marcarComo(fieldset, 'activo')
    }
  })

  // muestra boton pagar
  form.on('afterValidate', function(e, messages, errorAttributes) {
    haCambiado = true
    puedePagar = (errorAttributes.length == 0)
    if (!puedePagar) {
      $('#btn-pagar').attr('disabled', true)
    }
  })

  // envio del form
  form.submit(function(e) {
    haCambiado = null
  });

  // previene salida de la pagina
  window.onbeforeunload = function() {
    return haCambiado
  }

})

