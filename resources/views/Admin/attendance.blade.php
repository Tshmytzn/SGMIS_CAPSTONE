<!doctype html>

<html lang="en">
@include('Admin.components.header', ['title' => 'Attendance'])
<style>
    .dataTables_filter, .dataTables_info { display: none; }
</style>
<body>
    <script src="{{ asset('./dist/js/demo-theme.min.js?1684106062') }}"></script>
    <div class="page">
        @include('Admin.components.nav', ['active' => 'Attendance'])
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
                                Attendance
                            </h2>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-deck row-cards">

                        <div class="card">

                            <div class="row bg-success">
                                <div class="col-12 mb-3">
                                    <div class="my-2 my-md-0 flex-grow-1 flex-md-grow-0 order-first order-md-last">
                                    
                                            <div class="input-icon mt-2 ">
                                                <span class="input-icon-addon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                                        width="24" height="24" viewBox="0 0 24 24"
                                                        stroke-width="2" stroke="currentColor" fill="none"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                                        <path d="M21 21l-6 -6" />
                                                    </svg>
                                                </span>
                                                <input type="text" id="customSearchInput" class="form-control" placeholder="Search…" aria-label="Search in table">

                                            </div>
                                    </div>
                                </div>

                                <div class="col-2 mb-3">
                                    <h4 class="mb-2 ms-2 text-white" for=""> Events </h4>
                                    <select class="form-select" name="" id="EventId" onchange="getAct()">
                                        <option value="" selected> Select Event </option>
                                        @php
                                            $events = \App\Models\SchoolEvents::all();
                                        @endphp
                                        @foreach ($events as $event)
                                        <option value="{{ $event->event_id }}">{{ $event->event_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-3 mb-3">
                                    <h4 class="mb-2 ms-2 text-white" for=""> Activities </h4>
                                    @include('Admin.components.Lloading',['load_ID' => 'lineLoading'])
                                    <select class="form-select" name="" id="ActId" onchange="getCourse()">
                                        <option value="" selected> Select Activity </option>
                                    </select>
                                </div>

                                <div class="col-3 mb-3">
                                    <h4 class="mb-2 ms-2 text-white" for=""> Department </h4>
                                    @include('Admin.components.Lloading',['load_ID' => 'lineLoading2'])
                                    <select class="form-select" name="" id="DeptId" onchange="getCourse()">
                                        <option value=""> Select Department </option>
                                    </select>
                                </div>


                                <div class="col-2 mb-3">
                                    <h4 class="mb-2 ms-2 text-white" for=""> Course </h4>
                                    @include('Admin.components.Lloading',['load_ID' => 'lineLoading3'])
                                    <select class="form-select" name="" id="CourseId" onchange="getSection()">
                                        <option value=""> Select Course </option>
                                    </select>
                                </div>


                                <div class="col-2 mb-3">
                                    <h4 class="mb-2 ms-2 text-white" for=""> Section </h4>
                                     @include('Admin.components.Lloading',['load_ID' => 'lineLoading4'])
                                    <select class="form-select" name="" id="SectionId" onchange="attendanceTable()">
                                        <option value=""> Select Section </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                            @include('Admin.components.Lloading',['load_ID' => 'lineLoading5'])
                            <div class="card mt-2 mb-4"  id="containerTable">
                                <div class="card-body">
                                    <table class="table table-hover" id="attendanceTable" style="text-align: center;">
                                        <thead>
                                            <tr>
                                                <th scope="col">Event Name</th>
                                                <th scope="col">Activity</th>
                                                <th scope="col">Department</th>
                                                <th scope="col">Course</th>
                                                <th scope="col">Section</th>
                                                <th scope="col">Student ID</th>
                                                <th scope="col">Student Name</th>
                                                <th scope="col">Attendance Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                    </div>
                </div>
            </div>

            <div class="modal fade" id="proofModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Proof Images</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body justify-content-center align-item-center text-center">
                    <div class="row">
                        <div class="col-6">
                            <label for="myImage">Time In</label>
                            <img id="myImage" src="default.jpg" class="rounded img-fluid" alt="Image">
                        </div>
                        <div class="col-6">
                            <label for="myImage">Time Out</label>
                             <img id="myImage2" src="default.jpg" class="img-fluid" alt="Image">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
            </div>

            @include('Admin.components.footer')

        </div>
    </div>


    @include('Admin.components.scripts')
    @include('Admin.components.attendancescript')

</body>

</html>
