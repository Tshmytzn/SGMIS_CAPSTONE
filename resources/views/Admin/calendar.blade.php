<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Calendar</title>
    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@5.11.3/main.min.js"></script>

    <style>
        /* Full Width Calendar */
        #calendar {
            max-width: 1100px;
            margin: 40px auto;
        }

        /* Style for the entire event block to occupy the whole day grid */
        .fc-daygrid-event {
            background-color: #ff7f50 !important; /* Coral background color */
            color: #fff !important;              /* White text color */
            border: none !important;             /* Remove borders */
            height: 100% !important;             /* Occupy the full height of the grid */
        }

        /* Make the event title fill the entire cell */
        .fc-daygrid-event .fc-event-title {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Style for the day cells (optional) */
        .fc-daygrid-day {
            border: 1px solid #ddd !important;
        }

        /* Style to ensure full height */
        .fc-event {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100% !important;
        }
    </style>
</head>
<body>

<h1 style="text-align:center;">Event Calendar</h1>
<div id="calendar"></div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth', // Display month view
            headerToolbar: {  // Navigation buttons
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: [
                @foreach($events as $event)
                {
                    title: '{{ $event->event_name }}',
                    start: '{{ $event->event_start }}',
                    end: '{{ $event->event_end }}',
                    allDay: true // Occupies entire day grid cell
                },
                @endforeach
            ],
            eventColor: '#ff7f50', // Set default event color
            eventTextColor: '#fff', // White text color for event
        });

        calendar.render();
    });
</script>

</body>
</html>
