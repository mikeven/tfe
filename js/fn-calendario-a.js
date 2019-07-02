$('#calendar').fullCalendar({
    header: {
      left: 'title',
      right: 'prev,today,next,basicDay,basicWeek,month'
    },

    timeFormat: 'h:mm',

    titleFormat: {
      month: 'MMMM YYYY',      // September 2009
        week: "MMM d YYYY",      // Sep 13 2009
        day: 'dddd, MMM d, YYYY' // Tuesday, Sep 8, 2009
    },

    themeButtonIcons: {
      prev: 'fa fa-caret-left',
      next: 'fa fa-caret-right',
    },

    editable: true,
    droppable: true, // this allows things to be dropped onto the calendar !!!
    drop: function(date, allDay) { // this function is called when something is dropped
      var $externalEvent = $(this);
      // retrieve the dropped element's stored Event Object
      var originalEventObject = $externalEvent.data('eventObject');

      // we need to copy it, so that multiple events don't have a reference to the same object
      var copiedEventObject = $.extend({}, originalEventObject);

      // assign it the date that was reported
      copiedEventObject.start = date;
      copiedEventObject.allDay = allDay;
      copiedEventObject.className = $externalEvent.attr('data-event-class');

      // render the event on the calendar
      // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
      $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

      // is the "remove after drop" checkbox checked?
      if ($('#RemoveAfterDrop').is(':checked')) {
        // if so, remove the element from the "Draggable Events" list
        $(this).remove();
      }

    },
    events: [
      {
        title  : 'event1',
        start  : '2019-07-01'
      },
      {
        title  : 'event2',
        start  : '2019-07-09'
      },
      {
        title  : 'event3',
        start  : '2019-07-05',
        allDay : false // will make the time show
      }
    ]
});