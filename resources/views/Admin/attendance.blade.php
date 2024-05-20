<!doctype html>

<html lang="en">
@include('Admin.components.header', ['title' => 'Attendance'])

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
                                        <form action="./" method="get" autocomplete="off" novalidate>
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
                                                <input type="text" value="" class="form-control"
                                                    placeholder="Search…" aria-label="Search in table">
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="col-3 mb-3">
                                    <h4 class="mb-2 ms-2 text-white" for=""> Events </h4>
                                    <select class="form-select" name="" id="">
                                        <option value=""> Select Event </option>
                                        <option value=""> Event 1 </option>
                                        <option value=""> Event 2 </option>
                                    </select>
                                </div>

                                <div class="col-3">
                                    <h4 class="mb-2 ms-2 text-white" for=""> Department </h4>
                                    <select class="form-select" name="" id="">
                                        <option value=""> Select Department </option>
                                        <option value=""> Department 1 </option>
                                        <option value=""> Department 2 </option>
                                    </select>
                                </div>


                                <div class="col-3">
                                    <h4 class="mb-2 ms-2 text-white" for=""> Course </h4>
                                    <select class="form-select" name="" id="">
                                        <option value=""> Select Course </option>
                                        <option value=""> Course 1 </option>
                                        <option value=""> Course 2 </option>
                                    </select>
                                </div>


                                <div class="col-3">
                                    <h4 class="mb-2 ms-2 text-white" for=""> Section </h4>
                                    <select class="form-select" name="" id="">
                                        <option value=""> Select Section </option>
                                        <option value=""> Section 1 </option>
                                        <option value=""> Section 2 </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                            <div class="card mt-2 mb-4">
                                <div class="card-body">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">Event Name</th>
                                                <th scope="col">Department</th>
                                                <th scope="col">Course</th>
                                                <th scope="col">Section</th>
                                                <th scope="col">Student Name</th>
                                                <th scope="col">Student ID</th>
                                                <th scope="col">Attendance Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td> Uweek </td>
                                                <td> College of Engineering </td>
                                                <td> BSIS </td>
                                                <td> Fourth Year A </td>
                                                <td> Tisha May Tizon </td>
                                                <td> 20201422 </td>
                                                <td class="alert alert-success"> Complete </td>
                                            </tr>
                                            <tr>
                                                <td> Uweek </td>
                                                <td> College of Engineering </td>
                                                <td> BSIS </td>
                                                <td> Fourth Year D </td>
                                                <td> John Paul Ubas </td>
                                                <td> 20201428 </td>
                                                <td class="alert alert-success"> Complete </td>
                                            </tr>
                                            <tr>
                                                <td> Uweek </td>
                                                <td> College of Engineering </td>
                                                <td> BSIS </td>
                                                <td> Fourth Year A </td>
                                                <td> Rheyan John Blanco </td>
                                                <td> 20201420 </td>
                                                <td class="alert alert-success"> Complete </td>
                                            </tr>
                                            <tr>
                                                <td> Uweek </td>
                                                <td> College of Engineering </td>
                                                <td> BSIS </td>
                                                <td> Fourth Year D </td>
                                                <td> Hazel Mae Santiago </td>
                                                <td> 20201424 </td>
                                                <td class="alert alert-success"> Complete </td>
                                            </tr>
                                            <tr>
                                                <td> Uweek </td>
                                                <td> College of Engineering </td>
                                                <td> BSIS </td>
                                                <td> Fourth Year B </td>
                                                <td> Jeah Lou Huelar </td>
                                                <td> 20201422 </td>
                                                <td class="alert alert-danger"> Incomplete </td>
                                            </tr>
                                            <tr>
                                                <td> Uweek </td>
                                                <td> College of Engineering </td>
                                                <td> BSIS </td>
                                                <td> Fourth Year A </td>
                                                <td> Tisha May Tizon </td>
                                                <td> 20201422 </td>
                                                <td class="alert alert-success"> Complete </td>
                                            </tr>
                                            <tr>
                                                <td> Uweek </td>
                                                <td> College of Engineering </td>
                                                <td> BSIS </td>
                                                <td> Fourth Year D </td>
                                                <td> John Paul Ubas </td>
                                                <td> 20201428 </td>
                                                <td class="alert alert-success"> Complete </td>
                                            </tr>
                                            <tr>
                                                <td> Uweek </td>
                                                <td> College of Engineering </td>
                                                <td> BSIS </td>
                                                <td> Fourth Year A </td>
                                                <td> Rheyan John Blanco </td>
                                                <td> 20201420 </td>
                                                <td class="alert alert-success"> Complete </td>
                                            </tr>
                                            <tr>
                                                <td> Uweek </td>
                                                <td> College of Engineering </td>
                                                <td> BSIS </td>
                                                <td> Fourth Year D </td>
                                                <td> Hazel Mae Santiago </td>
                                                <td> 20201424 </td>
                                                <td class="alert alert-success"> Complete </td>
                                            </tr>
                                            <tr>
                                                <td> Uweek </td>
                                                <td> College of Engineering </td>
                                                <td> BSIS </td>
                                                <td> Fourth Year B </td>
                                                <td> Jeah Lou Huelar </td>
                                                <td> 20201422 </td>
                                                <td class="alert alert-danger"> Incomplete </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                    </div>
                </div>
            </div>

            @include('Admin.components.footer')

        </div>
    </div>


    @include('Admin.components.scripts')

</body>

</html>
