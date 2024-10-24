<!doctype html>

<html lang="en">

@include('Admin.components.adminstyle')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" />

@include('Student.components.head', ['title' => 'Event Details'])
@include('Student.components.header')
@include('Student.components.nav')


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
                                        <th>Date</th>
                                        <th>Start</th>
                                        <th>End</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="act_list">
                                    <tr id="loading-act">
                                        <td colspan="8" class="text-center">
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
                                <div class="col-12" id="mapLoading">
                                    <div class="loader-container">
                                        <div class="bouncing-dots">
                                            <div class="dot"></div>
                                            <div class="dot"></div>
                                            <div class="dot"></div>
                                        </div>
                                    </div>
                                </div>
                                <div id="map"></div>
                                <form action="" id="attendanceForm" method="post" hidden>
                                    @csrf
                                    <input type="text" name="eact_id" id="event_id">
                                    <input type="text" name="process" id="" value="add">
                                    <input type="hidden" id="photo-input" name="photo">
                                </form>
                                <form action="" id="attendanceUpdateForm" method="post" hidden>
                                    @csrf
                                    <input type="text" name="eact_id" id="event_id2">
                                    <input type="text" name="process" id="" value="update">
                                    <input type="hidden" id="photo-input2" name="photo">
                                </form>
                                <div class="text-danger text-center mt-4" id="warning_label" style="display: none"> Your Attendance is Already Recorded</div>
                            </div>
                            <div class="modal-footer justify-content-center align-item-center text-center">
                                <h1>Proof of Attendance</h1>

    <!-- Video stream -->
    <video id="camera-stream" autoplay playsinline style="width: 100%; max-width: 600px;"></video>

    <!-- Capture button -->
    <button id="captureBtn" class="btn btn-primary">Capture Proof</button>

    <!-- Canvas to hold the photo -->
    <canvas id="canvas" style="display: none;"></canvas>

    <!-- Preview of the captured photo -->
    <img id="photo-preview" alt="Captured Photo" style="display: none; width: 100%; max-width: 600px;">

    <!-- Hidden input field to store base64 image data -->
    

                                <button type="button"  class="btn btn-primary w-100" data-bs-dismiss="modal" style="display: none" id="attend" onclick="dynamicFunction('attendanceForm',`{{route('Attendance')}}`)">Time
                                    In</button>
                                     <button type="button" id="attendOut" class="btn btn-primary w-100" data-bs-dismiss="modal" style="display: none" onclick="dynamicFunction('attendanceUpdateForm',`{{route('Attendance')}}`)">Time
                                    Out</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- MODALS --}}
            </div>
        </div>
        <script>
       
        </script>
        @include('Student.components.footer')
        @include('Student.components.scripts')
        @include('Student.components.eventscript')
        <!-- Bootstrap CSS -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
        <script src="{{ asset('./dist/libs/dropzone/dist/dropzone-min.js?1684106062') }}" defer></script>
        <!-- Bootstrap Bundle with Popper -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('./dist/libs/tom-select/dist/js/tom-select.base.min.js?1684106062') }}" defer></script>

        <!-- Include Leaflet JS library -->
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" defer></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js" defer></script>



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
