<!doctype html>

<html lang="en">
  
@include('Admin.components.header', ['title' => 'Accounts'])

  <body >
    <script src="{{asset('./dist/js/demo-theme.min.js?1684106062')}}"></script>

    <div class="page">

@include('Admin.components.nav', ['active' => 'Accounts'])

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
                  Accounts
                </h2>
              </div>
            </div>
          </div>
        </div>     
    
<!-- Page body -->
<div class="page-body" style="margin-top:1%">
  <div class="container-xl">
    <div class="card">

      
      {{-- Dropdown Year Level and Create Account --}}
        <div class="row">
     
            <div class="row justify-content-between mt-1">

            <div class="col-auto mx-3 mt-3">
              @php
              $courseId = request()->query('course_id');
          @endphp
              @php
                  $course = App\Models\Course::where('course_id', $courseId)->first();
              @endphp
              <h3>{{$course->course_name}}</h3>
            </div>

            <div class="col-auto text-end mx-1 mt-3">
              {{-- input year level here --}}
              @php
              $courseId = request()->query('course_id');
          @endphp
              @php
                  $course = App\Models\Course::where('course_id', $courseId)->first();
              @endphp
              <h3 id="yearTitle"></h3>
            {{-- input year level here --}}
            </div>
          </div>

          <div class="row justify-content-between mt-1 align-items-end">

            <div class="col-auto mx-3">
              <li class="nav-item dropdown" style="list-style-type: none;">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" style="background-color: #DF7026; color: white; border: none; padding: 0.5rem 1rem; border-radius: 0.300rem;">

                  <span class="nav-link-title" id="yeardropdown">
                     Year Level
                  </span>
                </a>
                <div class="dropdown-menu">

                  <div class="dropdown-menu-columns">
                    
                    <div class="dropdown-menu-column">
                      @php
                      $sections = App\Models\Section::where('course_id',$courseId)->get();
                  @endphp
                        <div class="dropend">
                            <a class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                              <!-- Download SVG icon from http://tabler-icons.io/i/file-minus -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline me-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M9 14l6 0" /></svg>
                              First Year
                            </a>
                            <div class="dropdown-menu">
                         @foreach ($sections as $section)
                             @if ($section->year_level == '1')
                             <button class="dropdown-item" onclick="selectSect(`{{$section->sect_id}}`,`{{$section->sect_name}}`,`{{$section->year_level}}`)">{{$section->sect_name}}</button>
                            @endif
                         @endforeach
                            </div>
                          </div>

                        <div class="dropend">
                            <a class="dropdown-item dropdown-toggle"  data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                              <!-- Download SVG icon from http://tabler-icons.io/i/file-minus -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline me-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M9 14l6 0" /></svg>
                              Second Year
                            </a>
                            <div class="dropdown-menu">
                              @foreach ($sections as $section)
                              @if ($section->year_level == '2')
                              <button class="dropdown-item" onclick="selectSect(`{{$section->sect_id}}`,`{{$section->sect_name}}`,`{{$section->year_level}}`)">{{$section->sect_name}}</button>
                            @endif
                          @endforeach
                              </div>
                          </div>

                      <div class="dropend">
                        <a class="dropdown-item dropdown-toggle"  data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline me-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M9 14l6 0" /></svg>
                            Third Year
                        </a>

                        <div class="dropdown-menu">
                          @foreach ($sections as $section)
                             @if ($section->year_level == '3')
                             <button class="dropdown-item" onclick="selectSect(`{{$section->sect_id}}`,`{{$section->sect_name}}`,`{{$section->year_level}}`)">{{$section->sect_name}}</button>
                             @endif
                         @endforeach
                          </div>
                        
                    </div>

                      <div class="dropend">
                        <a class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                          <!-- Download SVG icon from http://tabler-icons.io/i/file-minus -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline me-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M9 14l6 0" /></svg>
                          Fourth Year
                        </a>
                        <div class="dropdown-menu">
                          @foreach ($sections as $section)
                             @if ($section->year_level == '4')
                             <button class="dropdown-item" onclick="selectSect(`{{$section->sect_id}}`,`{{$section->sect_name}}`,`{{$section->year_level}}`)">{{$section->sect_name}}</button>
                             @endif
                         @endforeach
                          </div>
                      </div>

                      <div class="dropend">
                        <a class="dropdown-item dropdown-toggle"  data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                          <!-- Download SVG icon from http://tabler-icons.io/i/file-minus -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline me-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M9 14l6 0" /></svg>
                          Fifth Year
                        </a>
                        <div class="dropdown-menu">
                          @foreach ($sections as $section)
                             @if ($section->year_level == '5')
                             <button class="dropdown-item" onclick="selectSect(`{{$section->sect_id}}`,`{{$section->sect_name}}`,`{{$section->year_level}}`)">{{$section->sect_name}}</button>
                             @endif
                         @endforeach
                          </div>
                      </div>

                    </div>
                  </div>
                </div>
              </li>
            </div>
            <input type="hidden" name="selectSectId" id="selectSectId">
            <div class="col-auto text-end">
              <button class="btn" style="background-color: #DF7026; color: white;" data-bs-toggle="modal" data-bs-target="#createstudentacc" > Create Student Account</button>
            </div>
       
          </div>
          
        </div>
        {{-- Dropdown Year Level and Create Account --}}
              <input type="hidden" name="AutoCourse" id="AutoCourse" value="{{ $courseId}}">
              <div class="card-body gy-5" style="margin-top: -1%">
              <div id="table-default" class="table-responsive">
                <table class="table" id="GetStudentTable">
                  <thead>
                    <tr>
                      <th><button class="table-sort" data-sort="sort-name">Student ID</button></th>
                      <th><button class="table-sort" data-sort="sort-city">First Name</button></th>
                      <th><button class="table-sort" data-sort="sort-type">Middle Name</button></th>
                      <th><button class="table-sort" data-sort="sort-score">Last Name</button></th>
                      <th><button class="table-sort" data-sort="sort-date">Year/Section</button></th>
                      <th><button class="table-sort" data-sort="sort-date">Action</button></th>
                    </tr>
                  </thead>
                  <tbody class="table-tbody">
                  
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>


        {{-- MODALS --}}

        {{-- Create Account --}}
        <div class="modal modal-blur fade" id="createstudentacc" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header text-white" style="background-color: #3E8A34;">
                <h5 class="modal-title" id="staticBackdropLabel">Create Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form class="row g-3" method="POST" id="SaveStudentForm">@csrf
                <div class="row g-2">
                  <div class="col-12">
                    <label for="firstname" class="form-label">Department</label>
                    @php
                    $dept = App\Models\Department::all();
                  @endphp
                    <select class="form-select" name="selectdepartment" id="selectdepartment" onchange="GetDeptDataSavestudent()">
                      <option>Select Department</option>
                      @foreach ($dept as $dep)
              <option value="{{$dep->dept_id}}">{{$dep->dept_name}}</option>
              @endforeach                                  
                    </select>                  
                  </div>
                  <div class="col-12">
                    <label for="firstname" class="form-label">Courses</label>
                    @include('Admin.components.Lloading',['load_ID' => 'lineLoading'])
                    <select class="form-select" name="selectcourse" id="selectcourse">
                      <option>Select Course</option>                     
                  </select>                  
                </div>
                 <div class="col-12">
                  <label for="selectYearLevel" class="form-label">Year Level</label>
                  <select class="form-select" name="selectYearLevel" id="selectYearLevel" onchange="GetSectData()">      
                    <option value="">Select Year Level</option>
                    <option value="First Year">First Year</option>
                    <option value="Second Year">Second Year</option>
                    <option value="Third Year">Third Year</option>
                    <option value="Fourth Year">Fourth Year</option>
                    <option value="Fifth Year">Fifth Year</option>                 
                </select>                  
              </div>
                <div class="col-12">
                  <label for="firstname" class="form-label">Section</label>
                  @include('Admin.components.Lloading',['load_ID' => 'lineLoading2'])
                  <select class="form-select" name="selectsection" id="selectsection">                       
                </select>                  
              </div>
                  <div class="col-6">
                    <label for="firstname" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name">
                  </div>
                  <div class="col-6">
                    <label for="middlename" class="form-label">Middle Name</label>
                    <input type="text" class="form-control" id="middlename" name="middlename" placeholder="Middle Name">
                  </div>
                </div>
                <div class="row g-2">
                <div class="col-6">
                  <label for="lastname" class="form-label">Last Name</label>
                  <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name">
                </div>
                <div class="col-6">
                  <label for="lastname" class="form-label">Ext</label>
                  <select id="inputState" class="form-select" name="ext">
                    <option selected> None </option>
                    <option>I (First)</option>
                    <option>II (Second)</option>
                    <option>III (Third)</option>
                    <option>IV (Fourth)</option>
                    <option>V (Fifth)</option>
                    <option>VI (Sixth)</option>
                    <option>VII (Seventh)</option>
                    <option>VIII (Eighth)</option>
                    <option>IX (Ninth)</option>
                    <option>X (Tenth)</option>
                    <option>XI (Eleventh)</option>
                    <option>XII (Twelfth)</option>
                    <option>Junior</option>
                    <option>Senior</option>                                   
                  </select>                </div>
                </div>
                <hr class="my-4 mb-2">
                <div class="row g-2">
                  <div class="col-md-12">
                    <label for="studentid" class="form-label">Student ID</label>
                    <input type="number" class="form-control" id="studentid" name="studentid" placeholder="Student ID" oninput="if(this.value.length > 8) this.value = this.value.slice(0, 8);">
                  </div>
                  {{-- <div class="col-md-4">
                    <label for="inputState" class="form-label">Year Level</label>
                    <select id="inputState" class="form-select">
                      <option selected> Year Level</option>
                      <option>1st</option>
                      <option>2nd</option>
                      <option>3rd</option>    
                      <option>4th</option>                    
                      <option>5th</option>                                    
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label for="inputState" class="form-label">Section</label>
                    <select id="inputState" class="form-select">
                      <option selected> Section</option>
                      <option>A</option>
                      <option>B</option>
                      <option>C</option>
                      <option>D</option>
                    </select>
                  </div> --}}
                </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="SaveStudent()">Save</button>
              </div>
            </div>
          </div>
        </div>
        {{-- Create Account --}}

                {{-- edit Account --}}
                <div class="modal modal-blur fade" id="editstudentacc" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header text-white" style="background-color: #3E8A34;">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit Account</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form class="row g-3" method="POST" id="EditStudentForm">@csrf
                          <h5 class="modal-title" id="EditModalTitle"></h5>
                          <hr class="my-2 ">
                        <div class="row g-2">
                          <div class="col-6">
                            <input type="hidden" name="EditStudentID" id="EditStudentID">
                            <label for="firstname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="editfirstname" name="editfirstname" placeholder="First Name">
                          </div>
                          <div class="col-6">
                            <label for="middlename" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="editmiddlename" name="editmiddlename" placeholder="Middle Name">
                          </div>
                        </div>
                        <div class="row g-2">
                        <div class="col-6">
                          <label for="lastname" class="form-label">Last Name</label>
                          <input type="text" class="form-control" id="editlastname" name="editlastname" placeholder="Last Name">
                        </div>
                        <div class="col-6">
                          <label for="lastname" class="form-label">Ext</label>
                          <select id="editext" class="form-select" name="editext">
                            <option selected> None </option>
                            <option>I (First)</option>
                            <option>II (Second)</option>
                            <option>III (Third)</option>
                            <option>IV (Fourth)</option>
                            <option>V (Fifth)</option>
                            <option>VI (Sixth)</option>
                            <option>VII (Seventh)</option>
                            <option>VIII (Eighth)</option>
                            <option>IX (Ninth)</option>
                            <option>X (Tenth)</option>
                            <option>XI (Eleventh)</option>
                            <option>XII (Twelfth)</option>
                            <option>Junior</option>
                            <option>Senior</option>                                   
                          </select>                </div>
                        </div>
                        <hr class="my-4 mb-2">
                        <div class="row g-2">
                          <div class="col-md-6">
                            <label for="studentid" class="form-label">Student ID</label>
                            <input type="number" class="form-control" id="editstudentschoolid" name="editstudentschoolid" placeholder="Student ID" oninput="if(this.value.length > 8) this.value = this.value.slice(0, 8);">
                          </div>
                           <div class="col-md-6">
                            <label for="" class="form-label">Student Password</label>
                            <input type="password" class="form-control" id="editstudentpass" name="editstudentpass" placeholder="Change Password">
                          </div>
                        </div>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" onclick="EditStudent()">Save</button>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- edit Account --}}

        {{-- MODALS --}}

@include('Admin.components.footer')

      </div>
    </div>

@include('Admin.components.scripts')
@include('Admin.components.studentaccscript')

  </body>
</html>