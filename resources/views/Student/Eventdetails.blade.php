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
                    <div class="card mt-2">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Participating Departments</h3>
                        </div>
                        <div class="row row-cards" id="event_department_list">

                            <div class="page page-center mt-4" id="loading-dept">
                                <div class="container container-slim py-4">
                                    <div class="text-center">
                                        <div class="mb-3">
                                            <a href="." class="navbar-brand navbar-brand-autodark"><img
                                                    src="{{ asset('./static/logoicon.png') }}" height="50"
                                                    alt=""></a>
                                        </div>
                                        <div class="text-muted mb-3">Loading Departments</div>
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
                        radius: 150
                    }).addTo(map).bindPopup('Carlos Hilado Memorial State University Campus');

                    L.marker([10.7425, 122.9701]).addTo(map)
                        .bindPopup('<b>Carlos Hilado Memorial State University').openPopup();
                } else {
                    map.invalidateSize();
                }
            });
        </script>
</body>

</html>
