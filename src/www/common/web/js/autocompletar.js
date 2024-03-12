(function($) {

  String.prototype.clear = function() {
    return this.trim()
      .normalize('NFD')
      .replace(/[\u0300-\u036f]/g, "")
      .toLowerCase()
  }

  esVisible = function (el, holder) {
    return ((holder.height() - el.offset().top) > 0)
      && (el.offset().top >= 0)
      && ((el.offset().top - holder.offset().top) >= 0);
  }

  let moverSugerencia = function(direccion, ul) {
    // cambiar seleccionado
    lis = ul.find('li:visible')
    seleccionado = lis.filter('.seleccionado')
    ul.find('li').removeClass('seleccionado')
    index = lis.index(seleccionado)
    if (direccion == 'arriba' && index == -1) {
      li = lis.eq(lis.length - 1).addClass('seleccionado')
    } else if (direccion == 'abajo' && (index == lis.length - 1)) {
      li = lis.eq(0).addClass('seleccionado')
    } else if (direccion == 'arriba') {
      li = lis.eq(index - 1).addClass('seleccionado')
    } else {
      li= lis.eq(index + 1).addClass('seleccionado')
    }
    // mover scroll
    if (li.length && !(li.position().top > 0
      && (li.position().top + li.height()) < ul.height())) {
      if (direccion == 'arriba') {
        ul.scrollTop(ul.scrollTop()
          + li.offset().top
          - ul.offset().top
          - 6);
      } else {
        ul.scrollTop(ul.scrollTop()
          + li.offset().top
          + li.height()
          - ul.height()
          - ul.offset().top);
      }
    }
  }


  /**
   * Convierte un input de yii/ActiveField (.form-group)
   * a un input con autocompletado
   * @author Mario Vial <mvial@ubiobio.cl> 2024/02/05 11:36
   */
  $.fn.extend({
    'autocompletadoMultiple': function(options) {

      var defaults = {
        url: null,
      }

      var options =  $.extend(defaults, options)

      return this.each(function() {

        this.options = options || {}

        let self = this

        this.render = function() {
          this.formGroup = $(this).closest('.form-group')
          this.acm = $(`<div class="acm"></div>`)
          this.acm.on('click', function() {
            self.input.focus()
          })

          this.sugerencias = $(`<ul class="sugerencias"></ul>`)
          this.input = $(`<div class="input" contenteditable="true" tabindex="0"></div>`)


          this.nuevo = $(`<li class="nuevo"></li>`)
          this.seleccionados = $(`<ul class="seleccionados"></ul>`)

          this.nuevo.append(this.input)
          this.nuevo.append(this.sugerencias)
          this.seleccionados.append(this.nuevo)
          this.acm.append(this.seleccionados)
          this.formGroup.after(this.acm)
          this.formGroup.find('label').css('z-index', 1)
          $(this).attr('type', 'hidden')
        }

        this.traerData = function() {
          let val = this.value
          $.get(this.options.url, function(data) {
            $.each(data, function(i, elemento) {
              self.sugerencias.append(`<li data-id="${elemento.id}">
                ${elemento.nombre}
                <div class="quitar"> <span class="mdi mdi-close"></span> </div>
              </li>`)
            })
            $.each(val.split(','), function(i, e) {
              nombre = e.trim()
              id = null
              self.sugerencias.find('li').each(function(i, li) {
                if ($(li).text().clear() == nombre.clear()) {
                  $(li).addClass('disabled')
                  id = $(li).data('id')
                }
              })
              self.agregarElemento(nombre, id)
            })
          })
        }

        this.render()
        this.traerData()

        this.input.on('focusin', function() {
          self.formGroup.find('label').addClass('activo')
        })

        this.input.on('focusout', function() {
          self.ajustarLabel()
        })

        this.ajustarLabel = function() {
          if (self.input.is(':focus')
            || self.seleccionados.find('>li:not(.nuevo)').text().trim().length
            || self.input.text().length) {
            self.formGroup.find('label').addClass('activo');
          } else {
            self.formGroup.find('label').removeClass('activo');
          }
        }

        this.actualizarValue = function() {
          this.ajustarLabel()
          nombres = []
          self.seleccionados.find('>li:not(.nuevo)').each(function(i, li) {
            nombres.push($(li).text().trim())
          })
          self.formGroup.find('input').val(nombres.join(', ')).change()
        }

        this.agregarElemento = function(nombre, id = null) {
          nombre = nombre.trim()
          if (nombre.length == 0) return false
          repetido = false
          self.seleccionados.find('>li').each(function(i, li) {
            if ($(li).text().clear() == nombre.clear()) {
              $(li).effect('shake', {distance: 4})
              repetido = true
            }
          })
          if (repetido) {
            return false
          }
          nuevo = (id == null ? 'crear' : '')
          li = $(`<li class="${nuevo}" data-id="${id}">
            <div class="nombre"> ${nombre} </div>
            <div class="quitar"> <span class="mdi mdi-close"></span> </div>
          </li>`)
          li.on('click', '.quitar', function(e) {
            li = $(this).closest('li')
            id = li.data('id')
            self.sugerencias.find('[data-id="' + id + '"]').removeClass('disabled')
            li.remove()
            self.actualizarValue()
            self.input.focus()
          })
          self.nuevo.before(li)
          self.actualizarValue()
        }

        this.seleccionarSugerencia = function(li) {
          li.addClass('disabled')
          self.agregarElemento(li.text(), li.data('id'))
          self.input.val('').text('')
          self.sugerencias.scrollTop(0)
        }

        this.quitarSugerencia = function(li) {
          li.removeClass('disabled')
          li.siblings('.seleccionado').removeClass('seleccionado')
          id = li.data('id')
          self.seleccionados.find('> li[data-id="' + id + '"]').remove()
          self.actualizarValue()
          // acm.sugerencias.css('top', (acm.height() + 8) + 'px')
          self.input.focus()
        }

        this.sugerencias.on('mousedown', 'li', function(e) {
          self.input.text('')
          li = $(this)
          if (li.hasClass('disabled')) {
            self.quitarSugerencia(li)
          } else {
            self.seleccionarSugerencia(li)
          }
          if (!e.ctrlKey) {
            self.sugerencias.removeClass('abierta')
          }
          self.sugerencias.find('li').removeClass('seleccionado')
          setTimeout(function() { self.input.focus() }, 10)
        })

        this.input.on('keydown', function(e) {
          key = e.which
          switch(key) {
            case 38: // flecha arriba
              self.sugerencias.addClass('abierta')
              moverSugerencia('arriba', self.sugerencias)
              e.preventDefault()
              break;
            case 40: // flecha abajo
              self.sugerencias.addClass('abierta')
              moverSugerencia('abajo', self.sugerencias)
              e.preventDefault()
              break;
            case 13: // enter
              e.preventDefault()
              if (self.sugerencias.hasClass('abierta')
                && self.sugerencias.find('li.seleccionado:visible').length == 1) {
                self.sugerencias.find('.seleccionado').trigger('mousedown')
                self.sugerencias.removeClass('abierta')
                $(this).html('').focus()
              } else {
                if ($(this).text().trim().length) {
                  self.agregarElemento($(this).text())
                  $(this).html('').focus()
                }
              }
              break;
            case 188: // coma
              seleccionado = self.sugerencias.find('li.seleccionado:visible')
              if (self.sugerencias.hasClass('abierta')
                && seleccionado.length == 1
                && seleccionado.text().clear() == $(this).text().clear()) {
                self.agregarElemento($(this).text().trim(), seleccionado.data('id'))
                $(this).html('').focus()
                seleccionado.addClass('disabled')
              } else {
                self.agregarElemento($(this).text().trim())
                $(this).html('').focus()
              }
              e.preventDefault()
              break;
            case 9:  // tab
              if ($(this).text().trim().length) {
                self.agregarElemento($(this).text())
                $(this).html('').focus()
                e.preventDefault()
              }
              break;
            case 8: // delete
              if ($(this).text().clear().length == 0
                && self.seleccionados.find('>li').length > 0) {
                self.input.blur()
                self.sugerencias.removeClass('abierta')
                ultimo = self.seleccionados.find('>li').last().prev()
                ultimo.addClass('seleccionado')
                ultimo.prop('tabindex', 0)
                ultimo.on('blur', function (e) {
                  $(this).removeClass('seleccionado')
                })
                ultimo.on('keydown', function (e) {
                  if (e.which == 8 || e.which == 46) {
                    ultimo.find('.quitar').click()
                    self.input.focus()
                  }
                })
                ultimo.focus()
              }
              break;
          }
        })

        this.input.on('keyup', function(e) {
          self.ajustarLabel()
          if (e.which == 40 || e.which == 38) return true
          texto = $(this).text().clear()
          self.sugerencias.find('li').hide()
          self.sugerencias.find('li').each(function(i, li) {
            nombre = $(li).text().clear()
            if (nombre.indexOf(texto) != -1) {
              $(li).show()
            }
          })
          if (texto.length) {
            if (!self.sugerencias.hasClass('abierta')) {
              self.sugerencias.find('li').removeClass('seleccionado')
              self.sugerencias.addClass('abierta')
              self.sugerencias.scrollTop(0)
            }
          } else {
            self.sugerencias.removeClass('abierta')
          }
          if (self.sugerencias.hasClass('abierta')
            && !self.sugerencias.find('li.seleccionado:visible').length) {
            self.sugerencias.find('li').removeClass('seleccionado')
            self.sugerencias.find('li:visible').first().addClass('seleccionado')
          }
          if (self.sugerencias.find('li:visible').length == 0) {
            self.sugerencias.removeClass('abierta')
          }
        })

        this.input.on('blur', function() {
          if ($(this).text().length > 0) {
            self.agregarElemento($(this).text())
            $(this).text('')
          }
        })

        $(this).closest('form').submit(function(e) {
          self.actualizarValue()
        })

        $(document).on('click', function(e) {
          if ($(e.target).closest(self).length == 0) {
            self.sugerencias.removeClass('abierta')
          }
        })

      })
    },
  })


})(jQuery)
