

(function( $ ) {

	'use strict';

	var initCalendarDragNDrop = function() {
		$('#external-events div.external-event').each(function() {

			// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
			// it doesn't need to have a start or end
			var eventObject = {
				title: $.trim($(this).text()) // use the element's text as the event title
			};

			// store the Event Object in the DOM element so we can get to it later
			$(this).data('eventObject', eventObject);

			// make the event draggable using jQuery UI
			$(this).draggable({
				zIndex: 999,
				revert: true,      // will cause the event to go back to its
				revertDuration: 0  //  original position after the drag
			});

		});
	};

	var initCalendar = function() {

		
		var $calendar = $('#calendar');
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		var idu = $("#id_ssu").val();

		$calendar.fullCalendar({
			header: {
				left: 'title',
				right: 'prev,today,next,basicDay,basicWeek,month'
			},

			timeFormat: 'h:mm',

			titleFormat: {
				month: 'MMMM YYYY',      // September 2009
			    /*week: "d MMMM d MMMM",
			    day: 'dddd, MMMM d YYYY' // Tuesday, Sep 8, 2009*/
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
			eventDrop: function( event ) {

			    var f = event.start;
			    var nueva_fecha = moment(f, 'DD.MM.YYYY').format('YYYY-MM-DD');
			    var id_act = event.id;
			    
			    console.log( id_act + " " + nueva_fecha );
			    //reasignarFechaActividad( id_act, nueva_fecha, dayDelta );

			},
			events: {
				data:{ agendados: 1, id_u: idu },
	            url:"database/data-actividad.php",
	            type: 'POST', // Send post data
	            success: function(response) {
		            
		        },
	            error: function() {
	                alert('There was an error while fetching events.');
	            }
	        }
		});

		// FIX INPUTS TO BOOTSTRAP VERSIONS
		var $calendarButtons = $calendar.find('.fc-header-right > span');
		$calendarButtons
			.filter('.fc-button-prev, .fc-button-today, .fc-button-next')
				.wrapAll('<div class="btn-group mt-sm mr-md mb-sm ml-sm"></div>')
				.parent()
				.after('<br class="hidden"/>');

		$calendarButtons
			.not('.fc-button-prev, .fc-button-today, .fc-button-next')
				.wrapAll('<div class="btn-group mb-sm mt-sm"></div>');

		$calendarButtons
			.attr({ 'class': 'btn btn-sm btn-default' });

		return $calendar;
	};

	$(function() {
		
		initCalendar();
		initCalendarDragNDrop();
		
	});

}).apply(this, [ jQuery ]);