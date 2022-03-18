$(function () {

        /* initialize the external events
         -----------------------------------------------------------------*/
        function ini_events(ele) {
          ele.each(function () {

            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
              title: $.trim($(this).text()) // use the element's text as the event title
            };

            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);

            // make the event draggable using jQuery UI
            $(this).draggable({
              zIndex: 1070,
              revert: true, // will cause the event to go back to its
              revertDuration: 0  //  original position after the drag
            });

          });
        }
        //ini_events($('#external-events div.external-event'));

        /* initialize the calendar
         -----------------------------------------------------------------*/
        //Date for the calendar events (dummy data)
        var date = new Date();
        var d = date.getDate(), m = date.getMonth(), y = date.getFullYear();

   $.get(base_url_js+'recruitment/ajax_functions/get_calendar_sched', function(response){
      var schedObj = jQuery.parseJSON(response);

      $('#calendar').fullCalendar({
         header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
         },
         buttonText: {
            today: 'today',
            month: 'month',
            week: 'week',
            day: 'day'
         },

         /*populate calendar*/
         events: schedObj.sched_data,

         eventRender: function(event, element) { 
            element.find('.fc-title').append("<br/>" + event.description);
         } ,
         eventClick: function(event) {
            if (event.url) {
               window.open(event.url, "_blank");
               return false;
            }
         },
         editable: false,
         droppable: false,
      });
   });
});