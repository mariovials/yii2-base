// 167623794

window.addEventListener("pageshow", () => {

  /**
   * Variables
   */

  form = $('#orden-form')
  puedePagar = false
  haCambiado = null
  hh = $('#header').outerHeight()
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
    parte.find('header .descripcion').slideUp(400, function() {
      t = $(window).width() <= 800 ? hh + 10 : 0
      $('html, body').animate({
        scrollTop: parte.next().offset().top - t
      }, 200);
    })

  }

  irAParteAnterior = function(parte) {
    t = $(window).width() <= 800 ? hh + 10 : 0
    $('html, body').animate({
      scrollTop: parte.prev().offset().top - t
    }, 400);
    parte.find('main').slideUp()
    parte.prev().find('main').slideDown()
    parte.prev().find('header .descripcion').slideDown()
    parte.find('header .descripcion').slideUp()
  }

  actualizarTotal = function() {
    total = parseInt($('#montos li.total').data('monto'))
    $('#montos li.opcional.activo').each(function(i, e) {
      total += parseInt($(e).data('monto'))
    })
    monto = new Intl.NumberFormat('es-CL', {
      style: 'currency',
      currency: 'CLP',
    }).format(total).replace(/([\d,.]+)$/, ' $1');
    $('#montos li.total .monto').html(monto)
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

  $('#btn-copiar-direccion').on('click', function(e) {
    e.preventDefault()

    $('#direccion-direccion').val($('#cliente-direccion').val()).trigger('change')

    $('#direccion-comuna').val($('#cliente-comuna').val())
    $('.field-direccion-comuna label').addClass('activo')

    region = $(`#direccion-comuna option:selected`).data('region_id')
    $('#direccion-region option').removeAttr('selected')
    $('#direccion-region').val(region)
    $('.field-direccion-region label').addClass('activo')

    $('#direccion-region').trigger('change')
    $('#direccion-comuna').trigger('change')


  })

  $('#btn-validar-rut').on('click', function() {
    form.yiiActiveForm('validateAttribute', 'cliente-rut');
  })

  $('#btn-cambiar-rut').on('click', function() {
    $('#cliente-rut').val('').focus()
    $('#btn-cambiar-rut').hide()
    $('#btn-validar-rut').show()
    $('.field-cliente-rut').removeClass('readonly')
    $('.field-cliente-rut :input').removeAttr('readonly')
    $('.fila.responsable :input').val('');
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

  $('#orden-acepta_todo').on('change', function() {
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
      $('#orden-acepta_todo').prop('checked', true)
    } else {
      $('#orden-acepta_todo').prop('checked', false)
    }
    validarParte($('#terminos'))
  })

  $('[name="Paciente[tiene_medico]"]').on('change', function() {
    revisarMedico()
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

  revisarMedico = function() {
    if ($('[name="Paciente[tiene_medico]"]:checked').val() == 1) {
      // muestra fila medico
      $('.medico-veterinario').slideDown()
      $('.medico-veterinario :input').prop('disabled', false)
    } else {
      // oculta fila medico
      form.yiiActiveForm('updateAttribute', 'paciente-medico', '');
      $('.medico-veterinario :input').prop('disabled', true)
      $('.medico-veterinario').slideUp()
    }
  }

  /**
   * Envío de datos
   */

  $('#paciente-tiene_medico input').on('change', function() {
    if ($(this).val() == '1') {
      $('.field-paciente-medico').addClass('required')
    } else {
      $('.field-paciente-medico').removeClass('required')
    }
  })

  /**
   * Manejo de datos (autocompletado)
   */

  $('#orden-paciente_id').on('change', function () {
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
          if (data.cliente != undefined && data.cliente.id != cliente_id) {

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
            $('#orden-paciente_id').find('option[value!="-1"]').remove()
            $('#orden-paciente_id').prepend(options)
            $('#orden-paciente_id').trigger('change')
            $('#paciente .filas.selector').slideDown()

            // direccion
            options = ''
            cantidad = 0
            $.each(data.direcciones, function(i, direccion) {
              if (i == 0) {
                direccion_id = direccion.id
                selected = 'selected'
              }
              options += `<option ${selected} value="${direccion.id}">
                ${direccion.nombre}
              </option>`
            })
            $('#orden-direccion_id').find('option[value!="-1"]').remove()
            $('#orden-direccion_id').prepend(options)
            $('#orden-direccion_id').trigger('change')
            $('#direccion .filas.selector').slideDown()
          }
        })
      }
    }
  })

  // revisar paciente.estado (urgencia)
  form.on('afterValidateAttribute', function(event, attribute, messages) {
    if (attribute.id == 'paciente-estado') {
      if (attribute.value == '4') {
        $('#monto .urgencia').addClass('activo')
        $('.nota.urgencia').slideDown()
      } else {
        $('#monto .urgencia').removeClass('activo')
        $('.nota.urgencia').slideUp()
      }
    }
  })

  // revisar cliente.tipo (revisarResponsable)
  form.on('afterValidateAttribute', function(event, attribute, messages) {
    if (attribute.id == 'cliente-tipo') {
      if (attribute.value == '1') { // tutor

        // ajusta monto
        $('#monto .toma-muestra').addClass('activo')

        revisarMedico()

        // ajusta notas
        $('.nota.medico').hide()
        $('.nota.retiro').hide()
        $('.nota.muestra').show()
        $('.nota.tutor').show()

        // muestra tiene medico
        $('#paciente-tiene_medico input').prop('disabled', false)
        $('.fila.tiene-medico').slideDown()

        // quita direccion
        $('.filas-direccion :input').prop('disabled', false)
        $('.filas-direccion').slideDown()

        // ajusta tipo entrega (marca entrega y oculta fila)
        $('#orden-tipo_entrega input').prop('disabled', true)
        $('#orden-tipo_entrega input[value="3"]')
          .prop('disabled', false)
          .prop('checked', true)
        $('.fila.tipo-entrega').slideUp()

        // ajusta header de muestra
        $('#muestra header .descripcion')
          .html('Dinos la dirección para ir a tomar las muestras')
        $('#muestra header .descripcion').slideDown()

        // requiere tiene medico
        $('.field-paciente-tiene_medico').addClass('required');
        attr = form.yiiActiveForm('find', 'paciente-tiene_medico')
        form.yiiActiveForm('add', {
          id: attr.id,
          name: attr.name,
          container: attr.container,
          input: attr.input,
          error: attr.error,
          validate: function(attribute, value, messages) {
            yii.validation.required(value, messages, {
              message: "Tiene médico veterinario no puede estar vacío.",
            });
          }
        });

      }
      if (attribute.value == '2') { // médico

        // ajusta monto
        $('#monto .toma-muestra').removeClass('activo')
        $('#monto .retiro-muestra').removeClass('activo')

        // ajusta notas
        $('.nota.tutor').hide()
        $('.nota.medico').show()

        // tipo entrega
        $('#orden-tipo_entrega input')
          .prop('disabled', false)
          .closest('label')
          .show()
        $('#orden-tipo_entrega input[value="3"]')
          .prop('disabled', true)
          .closest('label')
          .hide()

        // ajusta header de muestra
        $('#muestra header .descripcion')
          .html('¿Cómo obtenemos las muestras?')

        // no requiere y oculta tiene medico
        $('.field-paciente-tiene_medico').removeClass('required');
        form.yiiActiveForm('updateAttribute', 'paciente-tiene_medico', '')
        $('#paciente-tiene_medico input').prop('disabled', true)
        $('.fila.tiene-medico').slideUp()
        $('.fila.medico-veterinario').slideUp()

        // oculta direccion
        $('.filas-direccion').slideUp()
        // muestra tipo entrega
        $('.fila.tipo-entrega').slideDown()
      }
    }
  })

  // selector de region / comuna
  $('#direccion-region').on('change', function() {
    val = $(this).val()
    if (val) {
      $('#direccion-comuna').prop('disabled', false)
      $('#direccion-comuna option').attr('disabled', true).hide()
      $(`#direccion-comuna option[data-region_id="${val}"]`)
        .removeAttr('disabled')
        .show()
    } else {
      $('#direccion-comuna').prop('disabled', true)
    }
    if ($('#direccion-comuna option:selected').data('region_id') != val) {
      $('#direccion-comuna').val('')
        .closest('.form-group')
        .find('label.activo')
        .removeClass('activo')
    }
    form.yiiActiveForm('updateAttribute', 'direccion-comuna', '')
  })

  // revisar orden.tipo_entrega
  form.on('afterValidateAttribute', function(event, attribute, messages) {
    if (attribute.id == 'orden-tipo_entrega') {
      if (attribute.value == '1') { // entrega presencial
        $('.filas-direccion :input').prop('disabled', true)
        $('.filas-direccion').slideUp()
        $('.nota.retiro').hide()
        $('.nota.entrega').show()
        form.yiiActiveForm('updateAttribute', 'direccion-region', '');
        form.yiiActiveForm('updateAttribute', 'direccion-comuna', '');
        form.yiiActiveForm('updateAttribute', 'direccion-direccion', '');
      }
      if (attribute.value == '2') { // retiro de muestras
        $('#monto .retiro-muestra').addClass('activo')
        $('.filas-direccion :input').prop('disabled', false)
        $('.filas-direccion').slideDown()
        $('.nota.retiro').show()
        $('.nota.entrega').hide()
        $('.nota.muestra').hide()
      } else {
        $('#monto .retiro-muestra').removeClass('activo')
      }
      if (attribute.value == '3') { // toma de muestras
        $('.filas-direccion').slideDown()
      }
    }
  })

  // actualizar total
  form.on('afterValidateAttribute', function(event, attribute, messages) {
    if (attribute.id == 'cliente-tipo'
      || attribute.id == 'paciente-estado'
      || attribute.id == 'orden-tipo_entrega') {
      actualizarTotal()
    }
  })

  // valida comuna
  form.on('beforeValidateAttribute', function(e, attribute, messages) {
    if (attribute.id == 'cliente-comuna') {
      value = $(`#${attribute.id}`).val()
      if (!$(`#${attribute.id}-list option[value="${value}"]`).length) {
        messages.push(`Comuna '${value}' no existe`)
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
    // return haCambiado
  }

})

