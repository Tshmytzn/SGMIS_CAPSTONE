<!doctype html>

<html lang="en">

@include('Admin.components.header', ['title' => 'Party Candidates'])
@include('Admin.components.adminstyle')

<style>
    .fade-card {
        opacity: 0;
        transform: scale(0.5);
        /* Make it slightly smaller */
        transition: opacity 0.5s ease, transform 0.5s ease;
    }

    /* Pop-up animation */
    .fade-card.show {
        opacity: 1;
        transform: scale(1);
    }

    .parallax {
        height: 400px;
        /* Adjust the height as needed */
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        /* This makes the parallax effect */
        background-repeat: no-repeat;
    }

    .table-responsive {
        width: 100% !important;
    }

    #SelectStundentTable {
        width: 100% !important;
        table-layout: auto;
        /* Or fixed, based on your preference */
    }

    .form-control {
        width: 100% !important;
        /* Ensures input fields also take up full width */
    }
</style>

<body>
    <script src="{{ asset('./dist/js/demo-theme.min.js?1684106062') }}"></script>

    <div class="page">

        @include('Admin.components.nav', ['active' => ''])

        <div class="page-wrapper">

            <!-- Page header -->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">

                            <!-- Page pre-title -->
                            <div class="page-pretitle" >
                                <h3 id="partyGroup"></h3>
                            </div>
                            <h2 class="page-title">
                                Candidates
                            </h2>
                        </div>
                        <div class="col-auto ms-auto d-print-none">
                            <div class="d-flex">


                                <button class="btn" style="background-color: #DF7026; color: white;"
                                    data-bs-toggle="modal" data-bs-target="#addCandi">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-user-plus">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                        <path d="M16 19h6" />
                                        <path d="M19 16v6" />
                                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                                    </svg>
                                    Add Candidate</button>

                            </div>
                        </div>



                    </div>
                </div>
            </div>
            {{-- <div class="col-md-6 col-lg-2 fade-card" style="height: 200px;"> <!-- Fixed height -->
                <div class="card card-link card-link-pop folder2" style="height: 100%;"> <!-- Full height for the card -->
                  <div style="width: 100%; height: 100%; border: 2px dashed #000; padding: 2px; box-sizing: border-box;"> <!-- Dashed border and padding -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user-plus" style="width: 100%; height: 100%;"> <!-- Make SVG fill the container -->
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                      <path d="M16 19h6" />
                      <path d="M19 16v6" />
                      <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                    </svg>
                  </div>
                </div>
              </div> --}}




            <!-- Page body -->
            <div class="page-body" id="pageB">
                <div class="container-xl">
                    <div class="row row-deck row-cards">
                        <div class="parallax card-img-top m-2 fade-card" id="partyCover"
                            style="height: 250px; background-size: cover; background-position: center;">
                        </div>
                    </div>
                    <br>
                    @include('Admin.components.lineLoading', ['loadID' => 'cardload'])

                        <div class="row row-cards  border border-primary p-4" id="cards" style="display: none">

                        </div>
                        <br>
                        <div class="row row-cards  border border-primary p-4" id="cards2" style="display: none">

                        </div>
                        <br>
                        <div class="row row-cards  border border-primary p-4" id="cards3" style="display: none">

                        </div>


                </div>
            </div>
            {{-- Create Party Modal --}}
            <div class="modal modal-blur fade" id="updateCandi" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header text-white" style="background-color: #3E8A34;">
                            <h5 class="modal-title" id="staticBackdropLabel">Update Candidate Form</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="row g-3" id="updateCadidateForm" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row g-2">
                                    <div class="col-12">

                                        <input type="text" id="candi_id" name="candi_id" hidden>
                                        <input type="text" name="method" value="update" hidden>
                                        <div class="mb-2">
                                            <img style="height: 40vh" class="card-img-top" alt="Event image"
                                                id="stud_pic">
                                        </div>
                                        <div class="mb-2">
                                            <label for="student_picture" class="form-label">Party Image</label>
                                            <input type="file" name="student_picture_update"
                                                id="student_picture_update" class="form-control" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" id="closeEvalForm" class="btn btn-danger"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary"
                                onclick="dynamicFunction('updateCadidateForm','{{ route('Candidate') }}')">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <form id="deleteMemberform" method="post" hidden>
                @csrf
                <input type="text" name="method" id="delete" value="delete">
                <input type="text" name="student_m" id="student_m">
            </form>
            {{-- Create Party modal --}}

            @include('Admin.components.footer')

        </div>
        {{-- Create Party Modal --}}
    <div class="modal modal-blur fade" id="addCandi2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header text-white" style="background-color: #3E8A34;">
                <h5 class="modal-title" id="staticBackdropLabel">Create Party Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" id="addCadidateForm2" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-2">
                        <div class="col-12">
                            <input type="text" id="party_id2" name="party_id" hidden>
                            <input type="text" name="group" id="groupBy" value="" hidden>
                            <input type="text" id="student_id2" name="student_id" hidden>
                            <input type="text" name="method" value="add" hidden>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="SelectStundentTable2"
                                    style="width: 100% !important;">
                                    <thead>
                                        <tr>
                                            <th>Full Name</th>
                                            <th>SCHOOL ID No.</th>
                                            <th>Department</th>
                                            <th>Course</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Data will be populated here -->
                                    </tbody>
                                </table>
                            </div>

                            <div class="mb-2">
                                <label for="student_name" class="form-label">Student Name</label>
                                <input type="text" name="student_name" class="form-control" id="student_name2"
                                    placeholder="Enter student name..." readonly>
                            </div>
                            <div class="mb-2" id="selectP">

                            </div>
                            <div class="mb-2">
                                <label for="student_picture" class="form-label">Party Image</label>
                                <input type="file" name="student_picture" id="student_picture"
                                    class="form-control" accept="image/*">
                            </div>
                        </div>
                    </div>


                </form>

            </div>
            <div class="modal-footer">
                <button type="button" id="closeEvalForm" class="btn btn-danger"
                    data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary"
                    onclick="dynamicFunction('addCadidateForm2','{{ route('Candidate') }}')">Save</button>
            </div>
        </div>
    </div>
</div>
{{-- Create Party modal --}}
    </div>
    {{-- Create Party Modal --}}
    <div class="modal modal-blur fade" id="addCandi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #3E8A34;">
                    <h5 class="modal-title" id="staticBackdropLabel">Create Party Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" id="addCadidateForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-2">
                            <div class="col-12">
                                <input type="text" id="party_id" name="party_id" hidden>
                                <input type="text" name="group" id="" value="1" hidden>
                                <input type="text" id="student_id" name="student_id" hidden>
                                <input type="text" name="method" value="add" hidden>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover" id="SelectStundentTable"
                                        style="width: 100% !important;">
                                        <thead>
                                            <tr>
                                                <th>Full Name</th>
                                                <th>SCHOOL ID No.</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Data will be populated here -->
                                        </tbody>
                                    </table>
                                </div>

                                <div class="mb-2">
                                    <label for="student_name" class="form-label">Student Name</label>
                                    <input type="text" name="student_name" class="form-control" id="student_name"
                                        placeholder="Enter student name..." readonly>
                                </div>
                                <div class="mb-2">
                                    <label for="student_position" class="form-label">Position</label>
                                    <select name="student_position" class="form-control" id="student_position">
                                        <option value="" disabled selected>Select Position</option>
                                        <option value="President">President</option>
                                        <option value="Vice President">Vice President</option>
                                        <option value="Senator">Senator</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label for="student_picture" class="form-label">Party Image</label>
                                    <input type="file" name="student_picture" id="student_picture"
                                        class="form-control" accept="image/*">
                                </div>
                            </div>
                        </div>


                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" id="closeEvalForm" class="btn btn-danger"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary"
                        onclick="dynamicFunction('addCadidateForm','{{ route('Candidate') }}')">Save</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Create Party modal --}}

    @include('Admin.components.scripts')
    @include('Admin.components.candidatescript')

</body>

</html>
