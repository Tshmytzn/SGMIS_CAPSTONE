<!doctype html>

<html lang="en">


<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" />

@include('Student.components.head', ['title' => 'Event Details'])
@include('Student.components.header')
@include('Student.components.nav')

<style>
    #map {
        height: 400px;
        width: 100%;
    }
</style>

<body>

    <div class="page">
        <div class="page-wrapper">
            <!-- Page header -->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <h2 class="page-title" style=" margin-top: -2%">
                                Event Details
                            </h2>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page body -->
            <div class="page-body">

                <div class="container-xl">
                    <div class="row mb-4">
                        <div class="col-12">
                            <button class="btn btn-primary btn-block w-100" data-bs-toggle="modal"
                                data-bs-target="#timeinmodal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-clock">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                                    <path d="M12 7v5l3 3" />
                                </svg>Click to Time in</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">

                            <div class="card" style="margin-top: -2%;">

                                <div class="card-header">
                                    <div class="container mx-3" style="margin-bottom: -1%;">
                                        <div class="row">
                                            <div class="col d-flex justify-content-between mt-2 ">
                                                <h3 style="margin-left: -3%">More Information</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="datagrid">
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">NAME</div>
                                            <div id="event_name" class="datagrid-content"></div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Event duration</div>
                                            <div class="datagrid-content" id="event_duration"></div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">START DATE & TIME</div>
                                            <div class="datagrid-content" id="event_start"></div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">END DATE & TIME</div>
                                            <div class="datagrid-content" id="event_end"></div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Creator</div>
                                            <div class="datagrid-content">
                                                <div class="d-flex align-items-center">
                                                    <span class="avatar avatar-xs me-2 rounded"
                                                        style="background-image: url({{ asset('./static/icon.jpg') }})"></span>
                                                    <span id="admin_name"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Date Created</div>
                                            <div class="datagrid-content" id="event_created"></div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Facilitators</div>
                                            <div class="datagrid-content" id="event_facilitator"></div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Description</div>
                                            <div id="event_description" class="datagrid-content">

                                            </div>
                                        </div>


                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-2">
                        <div class="table-responsive mt-4">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <h3 class="ms-4">Activity List</h1>

                            </div>
                            <hr class="mt-0">
                            <table class="table table-vcenter card-table">
                                <thead>
                                    <tr>
                                        <th>Activity Name</th>
                                        <th>Description</th>
                                        <th>Venue</th>
                                        <th>Facilitator</th>
                                        <th>Date & Time</th>
                                        
                                    </tr>
                                </thead>
                                <tbody id="act_list">
                                    <tr id="loading-act">
                                        <td colspan="6" class="text-center">
                                            <div class="text-muted mb-3 text-center">Loading Activities</div>
                                            <div class="progress progress-sm ">
                                                <div class="progress-bar progress-bar-indeterminate"></div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card mt-2">
                        <div class="col-auto w-100 mt-4 d-flex justify-content-between align-items-center">
                            <h3 class="ms-4"> Event Programme</h3>
                            <div class="d-flex gap-3 me-2 mb-2">
                                <button class="btn btn-primary " type="button" id="downloadAllBtn"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-download">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                        <path d="M7 11l5 5l5 -5" />
                                        <path d="M12 4l0 12" />
                                    </svg> Download All </button>
                            </div>
                        </div>
                        <hr class="mt-0">

                        {{-- event program download --}}
                        <div class="row row-cols-4 g-3 mx-3 mt-4" id="programme_list">

                            <div class="page page-center w-100  mt-4" id="loading-programme">
                                <div class="container container-slim py-4">
                                    <div class="text-center">
                                        <div class="mb-3">
                                            <a href="." class="navbar-brand navbar-brand-autodark"><img
                                                    src="{{ asset('./static/logoicon.png') }}" height="50"
                                                    alt=""></a>
                                        </div>
                                        <div class="text-muted mb-3">Loading Programme</div>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar progress-bar-indeterminate"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
               
                </div>

                {{-- MODALS --}}
                <div class="modal modal-blur fade" id="timeinmodal" tabindex="-1" role="dialog"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Check in Attendance</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <div id="map"></div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary w-100" data-bs-dismiss="modal">Time
                                    In</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- MODALS --}}
            </div>
        </div>
        @include('Student.components.footer')
        @include('Student.components.scripts')
        <!-- Bootstrap CSS -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
        <script src="{{ asset('./dist/libs/dropzone/dist/dropzone-min.js?1684106062') }}" defer></script>
        <!-- Bootstrap Bundle with Popper -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('./dist/libs/tom-select/dist/js/tom-select.base.min.js?1684106062') }}" defer></script>

        <!-- Include Leaflet JS library -->
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

        <script>
            // Initialize the map when the modal is shown
            var map;
            var modal = document.getElementById('timeinmodal');
            modal.addEventListener('shown.bs.modal', function() {
                if (!map) {
                    map = L.map('map').setView([10.7433, 122.9701], 16);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                    }).addTo(map);

                    L.circle([10.7425, 122.9701], {
                        color: '#008631',
                        fillColor: '#cefad0',
                        fillOpacity: 0.3,
                        radius: 100
                    }).addTo(map).bindPopup('Carlos Hilado Memorial State University Campus');

                    // Define the custom icon using the SVG for the school
                    var schoolIcon = L.divIcon({
                        html: '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="currentColor"  class="icon icon-tabler icons-tabler-filled icon-tabler-book"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12.088 4.82a10 10 0 0 1 9.412 .314a1 1 0 0 1 .493 .748l.007 .118v13a1 1 0 0 1 -1.5 .866a8 8 0 0 0 -8 0a1 1 0 0 1 -1 0a8 8 0 0 0 -7.733 -.148l-.327 .18l-.103 .044l-.049 .016l-.11 .026l-.061 .01l-.117 .006h-.042l-.11 -.012l-.077 -.014l-.108 -.032l-.126 -.056l-.095 -.056l-.089 -.067l-.06 -.056l-.073 -.082l-.064 -.089l-.022 -.036l-.032 -.06l-.044 -.103l-.016 -.049l-.026 -.11l-.01 -.061l-.004 -.049l-.002 -.068v-13a1 1 0 0 1 .5 -.866a10 10 0 0 1 9.412 -.314l.088 .044l.088 -.044z" /></svg>',
                        className: '',
                        iconSize: [24, 24]
                    });

                    // Define the custom icon using the SVG for the student
                    var studentIcon = L.divIcon({
                        html: '<svg fill="#000000" height="24px" width="24px" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 494.881 494.881" xml:space="preserve"><g><path d="M196.782,63.877c-0.067,0.913-0.276,1.787-0.276,2.719c0,25.56,20.716,46.269,46.273,46.269c25.588,0,46.286-20.71,46.286-46.269c0-0.932-0.222-1.806-0.27-2.719H197.09H196.782z"/><path d="M366.799,278.201l-65.993-144.592c-3.881-8.501-11.933-11.822-21.559-11.822h-71.872c-8.525,0-16.177,1.996-20.882,8.759l-9.122,13.156l9.835-3.751l32.864-12.561c13.845-5.289,29.272,1.756,34.481,15.43l26.135,68.445c5.228,13.692-1.55,29.193-15.427,34.482l-25.329,9.664c-6.175,10.232-17.32,16.693-29.438,16.693c-5.849,0-24.418-4.521-30.76-5.904l-8.23,146.896c-0.179,2.992,0.886,5.912,2.958,8.087c2.036,2.175,4.915,3.404,7.892,3.404h4.269v46.541c0,13.116,10.647,23.751,23.761,23.751c13.12,0,23.761-10.635,23.761-23.751v-46.541h17.302v46.541c0,13.116,10.641,23.751,23.761,23.751c13.119,0,23.76-10.635,23.76-23.751v-46.541h4.299c2.996,0,5.837-1.229,7.892-3.388c2.054-2.167,3.137-5.08,2.977-8.057l-9.153-175.039l25.815,56.528c4.54,9.989,16.3,14.306,26.215,9.794C366.959,299.883,371.344,288.142,366.799,278.201z"/><path d="M179.314,195.475l38.474,8.408c15.802,3.444,26.609,17.25,27.027,32.719l14.787-5.642c5.561-2.12,8.439-8.377,6.286-14.049l-26.135-68.439c-2.153-5.637-8.458-8.41-14.055-6.282l-48.069,18.366c-5.628,2.142-8.439,8.433-6.292,14.046L179.314,195.475z"/><path d="M209.361,257.308c9.109,0,17.309-6.317,19.314-15.569c2.344-10.685-4.435-21.227-15.107-23.564l-41.26-9.016l-5.16-1.132l-10.611-27.771c-0.578-1.554-0.965-3.131-1.261-4.706l-25.452,36.666c0,0.016-0.019,0.031-0.037,0.056l-0.062,0.105c-3.801,5.452-4.336,13.012-2.171,18.52c2.141,5.395,7.603,10.65,14.203,12.094C145.072,243.719,206.095,257.308,209.361,257.308z"/><path d="M182.869,16.56h14.221v33.092h91.974V16.56h7.553v41.808c0,4.287,3.672,8.283,8.285,8.283c4.576,0,8.28-3.703,8.28-8.283V8.279c0-4.602-3.027-8.279-9.897-8.279H182.869c-6.858,0-9.897,3.678-9.897,8.279C172.972,12.883,176.011,16.56,182.869,16.56z"/></g></svg>',
                        className: '',
                        iconSize: [24, 24]
                    });

                    // Add the school marker with the custom icon
                    L.marker([10.7425, 122.9701], { icon: schoolIcon }).addTo(map)
                        .bindPopup('<b>Carlos Hilado Memorial State University</b>').openPopup();

                    // Check if Geolocation is available
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function(position) {
                            var userLat = position.coords.latitude;
                            var userLng = position.coords.longitude;

                            // Add a marker for the user's location with the custom student icon
                            L.marker([userLat, userLng], { icon: studentIcon }).addTo(map)
                                .bindPopup('<b>Your Location</b>').openPopup();

                            // Optionally, adjust the map view to include the user's location
                            map.setView([userLat, userLng], 16);

                        }, function(error) {
                            console.error("Error retrieving location: " + error.message);
                        });
                    } else {
                        console.error("Geolocation is not supported by this browser.");
                    }
                } else {
                    map.invalidateSize();
                }
            });
        </script>


<script>
    //Event Details Load
    window.onload = function(){
        EventDetailsLoad("{{route('getEventDetails')}}?event_id={{$event_id}}", "{{ asset('event_images/') }}");
        LoadEventActivities("{{ route('getEventAct') }}?event_id={{ $event_id }}", "{{ route('deleteEventActivities') }}", "{{ route('getActDetails') }}", 'student');
        LoadProgrammeList("{{ route('getProgramme') }}?event_id={{ $event_id }}","{{asset('programme_images')}}", "{{asset('static/illustrations/undraw_joyride_hnno.svg')}}", "{{route('removeProgramme')}}", 'student');
    }
</script>
</body>

</html>
