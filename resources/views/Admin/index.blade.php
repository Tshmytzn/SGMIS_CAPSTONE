<!doctype html>

<html lang="en">

@include('Admin.components.header', ['title' => 'Admin Dashboard'])
<link rel="stylesheet" type="text/css" href="css/evo-calendar.css"/>
<link rel="stylesheet" type="text/css" href="css/evo-calendar.royal-navy.css"/>
<body>
    <script src="{{ asset('./dist/js/demo-theme.min.js?1684106062') }}"></script>

    <div class="page">
        @include('Admin.components.nav', ['active' => 'Admin Dashboard'])
        @include('Admin.components.loading')
        <div class="page-wrapper">

            <!-- Page header -->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <!-- Page pre-title -->
                            <div class="page-pretitle">
                                Overview
                            </div>
                            <h2 class="page-title">
                                Dashboard
                            </h2>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-deck row-cards">
                        <div class="col-12">
                            <div class="row row-cards">
                                <div class="col-sm-6 col-lg-3">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span
                                                        class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-school">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M22 9l-10 -4l-10 4l10 4l10 -4v6" />
                                                            <path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4" />
                                                        </svg> </span>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium">
                                                        Students
                                                    </div>
                                                    <div class="text-muted">
                                                        @php
                                                            $Studentstotal = App\Models\StudentAccounts::all();
                                                            $count = $Studentstotal->count();

                                                        @endphp
                                                        {{ $count }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span
                                                        class="bg-green text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-section">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M20 20h.01" />
                                                            <path d="M4 20h.01" />
                                                            <path d="M8 20h.01" />
                                                            <path d="M12 20h.01" />
                                                            <path d="M16 20h.01" />
                                                            <path d="M20 4h.01" />
                                                            <path d="M4 4h.01" />
                                                            <path d="M8 4h.01" />
                                                            <path d="M12 4h.01" />
                                                            <path d="M16 4l0 .01" />
                                                            <path
                                                                d="M4 8m0 1a1 1 0 0 1 1 -1h14a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-14a1 1 0 0 1 -1 -1z" />
                                                        </svg>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium">
                                                        Sections
                                                    </div>
                                                    <div class="text-muted">
                                                        @php
                                                            $Sectionstotal = App\Models\Section::all();
                                                            $count = $Sectionstotal->count();

                                                        @endphp
                                                        {{ $count }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span
                                                        class="bg-twitter text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-certificate">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M15 15m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                                            <path d="M13 17.5v4.5l2 -1.5l2 1.5v-4.5" />
                                                            <path
                                                                d="M10 19h-5a2 2 0 0 1 -2 -2v-10c0 -1.1 .9 -2 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -1 1.73" />
                                                            <path d="M6 9l12 0" />
                                                            <path d="M6 12l3 0" />
                                                            <path d="M6 15l2 0" />
                                                        </svg>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium">
                                                        Programs
                                                    </div>
                                                    <div class="text-muted">
                                                        @php
                                                            $coursestotal = App\Models\Course::all();
                                                            $count = $coursestotal->count();

                                                        @endphp
                                                        {{ $count }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span
                                                        class="bg-facebook text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-facebook -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-building">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M3 21l18 0" />
                                                            <path d="M9 8l1 0" />
                                                            <path d="M9 12l1 0" />
                                                            <path d="M9 16l1 0" />
                                                            <path d="M14 8l1 0" />
                                                            <path d="M14 12l1 0" />
                                                            <path d="M14 16l1 0" />
                                                            <path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16" />
                                                        </svg>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium">
                                                        Departments
                                                    </div>
                                                    <div class="text-muted">
                                                        @php
                                                            $departmentstotal = App\Models\Department::all();
                                                            $count = $departmentstotal->count();

                                                        @endphp
                                                        {{ $count }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card">
                              <div class="col-12 row d-flex text-center m-2">
                                @php
                                  $data = App\Models\SetSemester::first();
                                @endphp
                                <div class="col-6">
                                  <input type="text" name="" id="fstart" value="{{$data->first_start}}" hidden>
                                  <input type="text" name="" id="fend" value="{{$data->first_end}}" hidden>
                                  <button class="btn btn-info" onclick="getFirtSem()">First Sem</button>
                                </div>
                                <div class="col-6">
                                  <input type="text" name="" id="sstart" value="{{$data->second_start}}" hidden>
                                  <input type="text" name="" id="send" value="{{$data->second_end}}" hidden>
                                  <button class="btn btn-info" onclick="getSecondSem()">Second Sem</button>
                                </div>
                              </div>
                                <div id="calendar2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal modal-blur fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header text-white" style="background-color: #3E8A34;">
                      <h5 class="modal-title">New Event</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="add_event" method="POST" enctype="multipart/form-data">
                      @csrf
                    <div class="modal-body">
          
                      <div class="mb-3">
                        <label class="form-label">Event Name   <span style="display: none" id="ev_name_e" class="text-danger ">(Don't Leave this field empty)</span></label>
                        <input type="text" class="form-control" id="ev_name" name="ev_name" placeholder="Event name">
          
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Event Facilitator   <span style="display: none" id="ev_facilitator_e" class="text-danger ">(Don't Leave this field empty)</span></label>
                        <input type="text" class="form-control" id="ev_facilitator" name="ev_facilitator" placeholder="Event Facilitator">
          
                      </div>
                  <div class="mb-2">
                    <label class="form-label">Event Photo   <span style="display: none;" id="ev_pic_e" class="text-danger ">(No Selected Photo! Please provide)</span></label>
                    <input type="file" id="ev_pic" class="form-control" accept="image/*" name="ev_pic" placeholder="Choose Event Cover Photo">
                </div>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="mb-3">
                              <label class="form-label">Event Start Date   <span style="display: none" id="ev_start_e" class="text-danger ">(Please Choose a date)</span></label>
                              <input type="date" onchange="getDays(this)" id="ev_start" name="ev_start" class="form-control">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="mb-3">
          
                            <label class="form-label">Event End Date   <span style="display: none" id="ev_end_e" class="text-danger ">(Please Choose a date)</span></label>
                            <input type="date" id="ev_end" onchange="getDays(this)" name="ev_end" class="form-control">
          
                          </div>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Duration</label>
                          <input type="text" class="form-control" disabled id="duration" placeholder="Event duration">
                      </div>
                        <div class="col-lg-12">
                          <div>
                            <label class="form-label">Event Description   <span style="display: none" id="ev_description_e" class="text-danger ">(Please provide a description)</span></label>
                            <textarea id="ev_description" name="ev_description" class="form-control" rows="2"></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" id="close-button" data-bs-dismiss="modal">Cancel</button>
                      <button type="button" onclick="VerifyFormEvent('{{route('saveEvent')}}', '{{ route('getEvent') }}', '{{ asset('event_images/') }}', '{{ route('deleteEvent') }}', '{{ route('EventDetails') }}', 'add')" class="btn btn-primary">Save</button>
                    </div>
                  </form>
                  </div>
                </div>
              </div>

            @include('Admin.components.footer')

        </div>
    </div>
    @include('Admin.components.dashboardscripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/evo-calendar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/min/moment.min.js"></script>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    $('#calendar2').evoCalendar({
        theme: 'Royal Navy', 
        calendarEvents: [ ]
    });
    $('#calendar2').on('selectDate', function(event, newDate, oldDate) {
            let elements = document.getElementsByClassName("event-list");
            for (let element of elements) {
                // Check if the button already exists
                if (!element.querySelector('.btn-primary')) {
                    element.innerHTML += `<button class="btn btn-primary col-12" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Event</button>`;
                }
            }
});
    // AJAX request to fetch additional events
    displayEv();
   
});
function getFirtSem() {
    const start = document.getElementById('fstart').value;
    const end = document.getElementById('fend').value;
    displayEv(start, end);
}

function getSecondSem() {
    const start = document.getElementById('sstart').value;
    const end = document.getElementById('send').value;
    displayEv(start, end);
}

function displayEv(startD, endD) {
    $.ajax({
        url: `{{route('getAllEvent')}}`, // Replace with actual route
        method: 'GET',
        success: function(data) {
            // Destroy the existing calendar before reinitializing
            $('#calendar2').evoCalendar('destroy');

            // Define the date range
            const startDate = moment(startD);
            const endDate = moment(endD);

            // Filter events based on the range, but include events with empty start or end date
            const filteredEvents = data.event.filter(function(event) {
                // Check if both start and end dates are empty
                if (!startD && !endD) {
                    return true; // Include all events if no start or end date is provided
                }

                // Check if event start or end date is missing
                if (!event.event_start || !event.event_end) {
                    return true; // Include event if start or end date is missing
                }

                // Convert event start and end to moment objects (subtract 1 day from start date)
                const eventStart = moment(event.event_start).format('YYYY-MM-DD');
                const eventEnd = moment(event.event_end).format('YYYY-MM-DD'); // Keep end date as is

                // Filter events that are within the specified date range
                return moment(eventStart).isBetween(startDate, endDate, 'days', '[]') || moment(eventEnd).isBetween(startDate, endDate, 'days', '[]');
            });

            // Initialize the calendar with filtered events
            $('#calendar2').evoCalendar({
    theme: 'Royal Navy',
    calendarEvents: filteredEvents.map(event => ({
        id: event.event_id,
        badge: `${event.event_start} - ${event.event_end}`, // Adjust display if necessary
        name: event.event_name,
        // Subtract 1 day from the start date to fix calendar rendering
        date: [moment(event.event_start).subtract(1, 'days').format('YYYY-MM-DD'), event.event_end], 
        description: event.event_description,
        type: "event", // Define event type as needed
        color: "#63d867" // Optional: define color or leave default
    }))
});


            // Force the calendar to show the correct range if needed
            const calendar = $('#calendar2').evoCalendar('getCalendar'); // Get the calendar instance
            calendar.showMonth(startDate.month() + 1);  // Set the month view to the one of the start date

        },
        error: function(xhr, status, error) {
            $('#result').html('<p>Error loading data: ' + error + '</p>');
        }
    });
}


function VerifyFormEvent(route, events, images, deleteEvent, eventDetails, meth) {
  const evname = document.getElementById('ev_name');
  const ev_pic = document.getElementById('ev_pic');
  const ev_start = document.getElementById('ev_start');
  const ev_end = document.getElementById('ev_end');
  const ev_facilitator = document.getElementById('ev_facilitator');
  const ev_description = document.getElementById('ev_description');

  const ev_name_e = document.getElementById('ev_name_e');
  const ev_pic_e = document.getElementById('ev_pic_e');
  const ev_facilitator_e = document.getElementById('ev_facilitator_e');
  const ev_start_e = document.getElementById('ev_start_e');
  const ev_end_e = document.getElementById('ev_end_e');
  const ev_description_e = document.getElementById('ev_description_e');

  let validity = 0;

  if (evname.value === "") {
    ev_name_e.style.display = '';
    evname.classList.add("border", "border-danger");
  } else {
    evname.classList.remove("border", "border-danger");
    ev_name_e.style.display = 'none';
    validity++;
  }


  if (ev_facilitator.value === "") {
    ev_facilitator_e.style.display = '';
    ev_facilitator.classList.add("border", "border-danger");
  } else {
    ev_facilitator.classList.remove("border", "border-danger");
    ev_facilitator_e.style.display = 'none';
    validity++;
  }



  if (ev_pic.files.length === 0 && meth === 'add') {
    ev_pic_e.style.display = '';
    ev_pic.classList.add("border", "border-danger");
  } else {
    ev_pic.classList.remove("border", "border-danger");
    ev_pic_e.style.display = 'none';
    validity++;
  }

  if (ev_start.value === '') {
    ev_start_e.style.display = '';
    ev_start.classList.add("border", "border-danger");
  } else {
    ev_start.classList.remove("border", "border-danger");
    ev_start_e.style.display = 'none';
    validity++;
  }

  if (ev_end.value === '') {
    ev_end_e.style.display = '';
    ev_end.classList.add("border", "border-danger");
  } else {
    ev_end.classList.remove("border", "border-danger");
    ev_end_e.style.display = 'none';
    validity++;
  }

  if (ev_description.value === '') {
    ev_description_e.style.display = '';
    ev_description.classList.add("border", "border-danger");
  } else {
    ev_description.classList.remove("border", "border-danger");
    ev_description_e.style.display = 'none';
    validity++;
  }

  if (validity === 6) {
    if (meth === 'add') {
      SaveEvent(route, events, images, deleteEvent, eventDetails);
    } else {
      UpdateEvent(route, events, images)
    }
  }
}
function getDays(date) {
  var dateStr1 = '';
  var dateStr2 = '';
  if (date.id === 'ev_start') {
    dateStr1 = date.value;
    dateStr2 = document.getElementById('ev_end').value;
  } else {
    dateStr1 = document.getElementById('ev_start').value;
    dateStr2 = date.value;
  }

  if (!dateStr1 || !dateStr2) {
    console.error('Both dates must be selected.');
    return;
  }

  const dateArr1 = dateStr1.split('-');
  const dateArr2 = dateStr2.split('-');

  const date1 = new Date(dateArr1[0], dateArr1[1] - 1, dateArr1[2]);
  const date2 = new Date(dateArr2[0], dateArr2[1] - 1, dateArr2[2]);


  if (isNaN(date1) || isNaN(date2)) {
    console.error('Invalid date format.');
    return;
  }

  const differenceMs = Math.abs(date1 - date2);

  const differenceDays = Math.ceil(differenceMs / (1000 * 60 * 60 * 24));


  document.getElementById('duration').value = differenceDays.toString() + ' Days Event';
}
function SaveEvent(route, events, images, deleteEvent, eventDetails) {
  document.getElementById('mainLoader').style.display = 'flex';
  const formData = new FormData($('#add_event')[0]);

  $.ajax({
    type: 'POST',
    url: route,
    data: formData,
    contentType: false,
    processData: false,
    success: res => {
      document.getElementById('mainLoader').style.display = 'none';
      alertify.set('notifier', 'position', 'top-center');
      if (res.status === 'success') {
        $('#exampleModal').modal('hide');
        alertify.success('Event Created').dismissOthers();
      } else {
        alertify.error('Invalid Image type: Please provide an actual image').dismissOthers();
      }
    },
    error: xhr => {
      console.log(xhr.responseText);
    }
  });
}
    </script>

</body>

</html>
