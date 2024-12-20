<!doctype html>

<html lang="en">

@include('Admin.components.header' , ['title' => 'Programs'])

@include('Admin.components.adminstyle')
{{-- @include('Admin.components.programsloader') --}}

  <body>

    {{-- <div class="loader-container">
      <div class="loader"></div>
  </div> --}}



    <script src="{{asset('./dist/js/demo-theme.min.js?1684106062')}}"></script>

    <div class="page">

@include('Admin.components.nav' , ['active' => 'Programs'])

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
                  Programs
                </h2>
              </div>
            </div>
          </div>
        </div>

        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">
            <div class="row row-deck row-cards">

              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                      <li class="nav-item">
                        <a href="#departments" class="nav-link active" data-bs-toggle="tab">Colleges</a>
                      </li>
                      <li class="nav-item">
                        <a href="#courses" class="nav-link" data-bs-toggle="tab">Programs</a>
                      </li>
                      <li class="nav-item">
                        <a href="#sections" class="nav-link" data-bs-toggle="tab">Class</a>
                      </li>
                    </ul>
                  </div>

                  <div class="card-body">
                    <div class="tab-content">

                  {{-- DEPARTMENTS TAB --}}
                      <div class="tab-pane fade active show" id="departments">
                        {{-- ADD DEPARTMENT --}}
                        <div class="container mx-3 mb-1">
                          <div class="row">
                              <div class="col d-flex justify-content-between mt-2 ">
                                  <div style="margin-left: -30px;">
                                    <h3>Carlos Hilado Memorial State of University Colleges </h3>
                                  </div>
                                  <button class="btn" type="button" style="background-color: #DF7026; color: white;" data-bs-toggle="modal" data-bs-target="#adddepartment">Add College</button>
                              </div>
                          </div>
                      </div>
                        {{-- ADD DEPARTMENT --}}
                            <div id="" class="table-responsive">
                              <table id="GetDepTable" class="table" style="width:100%">
                              <thead>
                                  <tr>
                                      <th>Name</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody class="table-tbody">

                              </tbody>

                          </table>
                                    </div>
                                </div>
                  {{-- DEPARTMENTS TAB --}}

                   {{-- COURSES TAB --}}
                      <div class="tab-pane fade" id="courses">
                        <div>
                          {{-- ADD Course --}}
                          <div class="container mx-3" style="margin-bottom: -1%;">
                            <div class="row">
                                <div class="col d-flex justify-content-between mt-2 ">
                                    <div style="margin-left: -20px;">
                                      <h3>Carlos Hilado Memorial State of University Programs </h3>
                                    </div>
                                    <button type="button" class="btn" style="background-color: #DF7026; color: white;" data-bs-toggle="modal" data-bs-target="#addcourse">Add Program</button>
                                </div>
                            </div>
                          </div>
                          {{-- ADD Course --}}
                              <div id="table-default" class="table-responsive">
                               <table id="GetCourseTable" class="table" style="width:100%">
                              <thead>
                                  <tr>
                                      <th>Colleges</th>
                                       <th>Programs</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody class="table-tbody">

                              </tbody>

                          </table>
                              </div>

                            </div>
                          </div>
                   {{-- COURSES TAB --}}

                   {{-- SECTIONS TAB --}}
                      <div class="tab-pane fade" id="sections">
                        <div>
                           {{-- ADD SECTION --}}
                            <div class="container mx-3" style="margin-bottom: -1%;">
                              <div class="row">
                                  <div class="col d-flex justify-content-between mt-2 ">
                                      <div style="margin-left: -20px;">
                                        <h3>Carlos Hilado Memorial State of University Classes </h3>
                                      </div>
                                      <button type="button" class="btn" style="background-color: #DF7026; color: white;" data-bs-toggle="modal" data-bs-target="#addsection">Add Class</button>
                                  </div>
                              </div>
                            </div>
                            {{-- ADD SECTION --}}
                            <div id="table-default" class="table-responsive">
                             <table id="GetSectionTable" class="table" style="width:100%">
                              <thead>
                                  <tr>
                                    <th>Colleges</th>
                                    <th>Programs</th>
                                    <th>Class</th>
                                    <th>Actions</th>
                                  </tr>
                              </thead>
                              <tbody class="table-tbody">

                              </tbody>

                          </table>
                            </div>
                        </div>
                      </div>
                     {{-- SECTIONS TAB --}}

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        {{-- MODALS --}}

        {{-- Add Department Modal --}}
        <div class="modal modal-blur fade" id="adddepartment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header text-white" style="background-color: #3E8A34;">
                <h5 class="modal-title" id="staticBackdropLabel">Add College</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">

                <form class="row g-3" id="adddepartmentform" method="POST" enctype="multipart/form-data">@csrf
                <div class="row g-2">
                  <div class="col-12">
                    <label for="firstname" class="form-label">College Image</label>
                    <input type="file" class="form-control" name="departmentimage" id="departmentimage" placeholder="Colleges Name">
                  </div>
                  <div class="col-12">
                    <label for="firstname" class="form-label">College Name</label>
                    <input type="text" class="form-control" name="department" id="department" placeholder="Colleges Name">
                  </div>
                </div>
                </form>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="SaveDepartment()">Save</button>
              </div>
            </div>
          </div>
        </div>
        {{-- Add Department Modal --}}

        {{-- EDIT Department Modal --}}
        <div class="modal modal-blur fade" id="editdepartment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header text-white" style="background-color: #3E8A34;">
                <h5 class="modal-title" id="staticBackdropLabel">Edit College</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">

                <form class="row g-3" id="editdeptform" method="POST" enctype="multipart/form-data">@csrf
                <div class="row g-2">
                  <div class="col-12">
                    <label for="" class="form-label">College Image</label>
                    <img src="" alt="" id="deptImage" width="50%">
                     <label for="" class="btn" data-bs-toggle="modal" data-bs-target="#editdepartmentpic" onclick="editdeptpic()">
                            Change Image
                        </label>
                  </div>
                  <div class="col-12">
                    <label for="firstname" class="form-label">College Name</label>
                    <input type="hidden" name="EditDeptId" id="EditDeptId">
                    <input type="text" class="form-control" id="EditDeptName" name="EditDeptName" placeholder="Colleges Name">
                  </div>
                </div>

                </form>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="EditDeptInfo()">Save</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal modal-blur fade" id="editdepartmentpic" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header text-white" style="background-color: #3E8A34;">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Colleges Picture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">

                <form class="row g-3" id="editdeptpicform" method="POST" enctype="multipart/form-data">@csrf
                <div class="row g-2">
                  <div class="col-12">
                    <label for="" class="form-label">Colleges Image</label>
                    <input type="hidden" name="deptpicid" id="deptpicid">
                     <label for="avatar-upload" class="btn">
                            Change Image
                            <input type="file" id="avatar-upload" style="display: none;">
                        </label>
                  </div>
                </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="EditDeptPicInfo()">Save</button>
              </div>
            </div>
          </div>
        </div>
        {{-- EDIT Department Modal --}}

        {{-- Add Course Modal --}}
        <div class="modal modal-blur fade" id="addcourse" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header text-white" style="background-color: #3E8A34;">
                <h5 class="modal-title" id="staticBackdropLabel">Add Program</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">

                <form class="row g-3" id="addcourseform" method="POST">@csrf
                <div class="row g-2">
                  <div class="col-12">
                    <label for="firstname" class="form-label">Colleges</label>
                    <select class="form-select" name="selectedDept" id="selectedDept">
                      @php
                        $dept = App\Models\Department::all();
                      @endphp
                      @foreach ($dept as $dep)
                      <option value="{{$dep->dept_id}}">{{$dep->dept_name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-12">
                    <label for="firstname" class="form-label">Program Name</label>
                    <input type="text" class="form-control" name="coursename" id="coursename" placeholder="Program Name">
                  </div>
                </div>

                </form>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="SaveCourse()">Save</button>
              </div>
            </div>
          </div>
        </div>
        {{-- Add Course Modal --}}

                {{-- EDIT Course Modal --}}
                <div class="modal modal-blur fade" id="editcourse" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header text-white" style="background-color: #3E8A34;">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit Programs</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">

                        <form class="row g-3" id="editcourseform" method="POST">@csrf
                        <div class="row g-2">
                          <div class="col-12">
                            <label for="firstname" class="form-label">Colleges</label>
                            <input type="hidden" name="editcourseid" id="editcourseid">
                            <select id="editcoursedept" name="editcoursedept" class="form-select">
                             @php
                        $dept = App\Models\Department::all();
                      @endphp
                      @foreach ($dept as $dep)
                      <option value="{{$dep->dept_id}}">{{$dep->dept_name}}</option>
                      @endforeach
                            </select>
                          </div>
                          <div class="col-12">
                            <label for="firstname" class="form-label">Course Name</label>
                            <input type="text" class="form-control" id="editcoursename" name="editcoursename" placeholder="Course Name">
                          </div>
                        </div>

                        </form>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" onclick="EditCourseInfo()">Save</button>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- EDIT Course Modal --}}

                {{-- Add Section Modal --}}
                <div class="modal modal-blur fade" id="addsection" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header text-white" style="background-color: #3E8A34;">
                        <h5 class="modal-title" id="staticBackdropLabel">Add Class</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">

                        <form class="row g-3" id="addsectionform" method="POST">@csrf
                        <div class="row g-2">
                          <div class="col-12">
                            <label for="firstname" class="form-label">Colleges</label>
                            <select class="form-select" name="selectdepartment" id="selectdepartment" onchange="GetDeptData()">
                              <option>Select Colleges</option>
                              @foreach ($dept as $dep)
                      <option value="{{$dep->dept_id}}">{{$dep->dept_name}}</option>
                      @endforeach
                            </select>
                          </div>
                          <div class="col-12">
                            <label for="firstname" class="form-label">Programs</label>
                            <select class="form-select" name="selectcourse" id="selectcourse">

                          </select>
                        </div>
                        <div class="col-12">
                          <label for="yearlevel" class="form-label">Year Level</label>
                          <select id="selectyear" name="selectyear" class="form-select" required>
                          <option value="null">Select Year Level</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select>
                      </div>
                          <div class="col-12">
                            <label for="firstname" class="form-label">Section</label>
                            <input type="text" class="form-control" name="section" id="section" placeholder="Section">
                          </div>
                        </div>

                        </form>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" onclick="SaveSection()">Save</button>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- Add Section Modal --}}

                {{-- EDIT Section Modal --}}
                <div class="modal modal-blur fade" id="editsection" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header text-white" style="background-color: #3E8A34;">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit Class</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">

                        <form class="row g-3" id="editsectionform" method="POST">@csrf
                        <div class="row g-2">
                          <div class="col-12">
                            <label for="firstname" class="form-label">Colleges</label>
                            <input type="hidden" name="editsectionid" id="editsectionid">
                            <select id="editsectiondept" name="editsectiondept" class="form-select" onchange="GetDeptData2()">
                            @foreach ($dept as $dep)
                      <option value="{{$dep->dept_id}}">{{$dep->dept_name}}</option>
                      @endforeach
                            </select>
                          </div>
                          <div class="col-12">
                            <label for="firstname" class="form-label">Programs</label>
                            <select id="editsectioncourse" name="editsectioncourse" class="form-select">

                          </select>
                        </div>
                        <div class="col-12">
                          <label for="yearlevel" class="form-label">Year Level</label>
                          <select class="form-select" id="editsectionyear" name="editsectionyear">
                          <option>Select Year Level</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select>
                      </div>
                          <div class="col-12">
                            <label for="firstname" class="form-label">Section</label>
                            <input type="text" class="form-control" id="editsectionname" name="editsectionname" placeholder="Section">
                          </div>
                        </div>

                        </form>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" onclick="EditSectionInfo()">Save</button>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- EDIT Section Modal --}}

        {{-- MODALS --}}

@include('Admin.components.footer')

      </div>
    </div>


@include('Admin.components.scripts')
@include('Admin.components.functionscript')
  </body>
</html>
