<!-- resources/views/calendar.blade.php -->

<div id="calendar"></div>
<!-- Include FullCalendar CSS and JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize FullCalendar
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay',
            },
            defaultView: 'month',
            events: '/calendar-events',
            eventRender: function (event, element) {
                console.log('Event Rendered:', event);
            },
        });


    });
</script>

