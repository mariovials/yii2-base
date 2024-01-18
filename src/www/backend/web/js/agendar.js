
  $('#lateral').remove();
  $('#contenido').css('padding-right', '0.3em');

  var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
    initialDate: initialDate,
    height: 'auto',
    locale: 'es',
    firstDay: 1,
    hiddenDays: [ 0 ],
    weekends: true,
    initialView: 'timeGridWeek',
    views: {
      timeGridWeek: {
        titleFormat: {
          year: 'numeric',
          month: 'long',
          day: '2-digit'
        }
      }
    },
    dayHeaderFormat: {
      weekday: 'short',
      day: 'numeric'
    },
    slotLabelFormat: {
      hour: 'numeric',
      minute: '2-digit',
      omitZeroMinute: false,
    },
    buttonText: {
      today:    'Hoy',
      month:    'Mes',
      week:     'Semana',
      day:      'Día',
      list:     'Lista'
    },
    headerToolbar: {
      left: 'today',
      center: 'title',
      right: 'prev,next',
    },
    businessHours: [
      {
        daysOfWeek: [1, 2, 3, 4, 5],
        startTime: '08:00',
        endTime: '19:00',
      },
      {
        daysOfWeek: [6],
        startTime: '08:00',
        endTime: '14:00',
      },
    ],
    nowIndicator: true,
    displayEventEnd: true,
    forceEventDuration: true,
    snapDuration: '00:10',
    slotDuration: '00:30',
    slotMinTime: '08:00',
    slotMaxTime: '19:00',
    editable: true,
    allDaySlot: false,
    handleWindowResize: true,
    displayEventTime: true,
    selectable: true,
    eventDurationEditable: false,
    eventColor: '#607D8B',
    events: {
      url: `/telemedicina/${telemedicinaId}/events`,
      eventDataTransform: function(e) {
        if (e.id == telemedicinaId) {
          e.color = '#00897B';
        }
        return e;
      },
    },
    dragRevertDuration: 100,
    droppable: false,
    eventAllow: function(i, event) {
      return event.id == 'nuevo' || event.id == telemedicinaId;
    },
    eventDrop: function(i) {
      cambiarFecha(i.event.start)
    },
    select: function(i) {
      evento = calendar.getEventById('nuevo') ?? calendar.getEventById(telemedicinaId)
      if (evento) {
        evento.remove()
      }
      end = new Date(i.start.getTime() + 20 * 60000)
      calendar.addEvent({
        id: 'nuevo',
        title: nombrePaciente,
        start: i.start,
        end: end,
        color: '#00897B',
      })
      cambiarFecha(i.start)
    },
  });
  calendar.render();

  cambiarFecha = function(start) {
    var d = ("0" + start.getDate()).slice(-2)
    var M = ("0" + (start.getMonth() + 1)).slice(-2)
    var y = start.getFullYear().toString().substr(-2)
    var h = ("0" + start.getHours()).slice(-2)
    var m = ("0" + start.getMinutes()).slice(-2)
    fecha = `${y}-${M}-${d} ${h}:${m}:00`
    $('#telemedicina-fecha').val(fecha)
  }
