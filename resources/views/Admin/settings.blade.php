<!doctype html>

<html lang="en">

@include('Admin.components.header', ['title' => 'Settings'])
@include('Admin.components.adminstyle')

  <body >
    <script src="{{asset('./dist/js/demo-theme.min.js?1684106062')}}"></script>
    <div class="page">

      @include('Admin.components.nav', ['active' => 'Settings'])

      <div class="page-wrapper">
        <!-- Page header -->

        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">
            <div class="card">
              <div class="row g-0">
                <div class="col-3 d-none d-md-block border-end">
                  <div class="card-body">
                    <h4 class="subheader">settings</h4>
                    <ul class="nav nav-pills flex-column">
                      <li class="nav-item">
                        <a class="nav-link active" id="my-account-tab" data-bs-toggle="pill" href="#my-account"><h3>My Account</h3></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="administrators-tab" data-bs-toggle="pill" href="#administrators"><h3>Primary Admins</h3></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="studentadmins-tab" data-bs-toggle="pill" href="#studentadmins"><h3>Student Admins</h3></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="studentadmins-tab" data-bs-toggle="pill" href="#setsemestertab"><h3>Set Semester</h3></a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="col d-flex flex-column">
                  <div class="card-body">
                    <div class="tab-content">
                      <div class="tab-pane fade show active" id="my-account">
                        <h2 class="mb-4">My Account </h2>
                        <div class="col d-flex flex-column">
                            @php
                              $adminAcc = App\Models\Admin::where('admin_id',session('admin_id'))->first();
                            @endphp
                            <h3 class="card-title">Profile Details</h3>
                            <form action="" method="POST" id="EditAdminInfoForm">
                              @csrf
                            <div class="row align-items-center">
                              <div class="col-auto"><span class="avatar avatar-xl"><img src="dept_image/{{$adminAcc->admin_pic}}" alt="" id="adminpicture"></span>
                              </div>
                              <div class="col-auto">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#uploadpic" class="btn">
                                  Change avatar
                              </button>
                            </div>
                            </div>
                            <h3 class="card-title mt-4">Student Profile</h3>



                            <div class="row g-3">
                              <div class="col-md">
                                <div class="form-label">Student Name</div>

                                <input type="text" class="form-control" name="adminname" id="adminname" value="{{$adminAcc->admin_name}}">
                              </div>
                              <div class="col-md">
                                <div class="form-label">Student ID</div>
                                <input type="text" class="form-control" name="adminschoolid" id="adminschoolid" value="{{$adminAcc->admin_school_id}}">
                              </div>
                            </div>
                             </form>
                            <h3 class="card-title mt-4">Password</h3>
                            <p class="card-subtitle">You can set a permanent password.</p>
                            <div>
                              <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#updatepassword">
                                Set new password
                              </a>
                            </div>

                          <div class="card-footer bg-transparent mt-3">
                            <div class="btn-list justify-content-end">
                              <button class="btn btn-primary" onclick="EditAdminInfo()">
                                Submit
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                      {{-- administrator --}}
                      <div class="tab-pane fade" id="administrators">
                      <div class="d-flex align-items-center justify-content-end mb-3">

                        <div class="input-icon">
                            <input type="text" value="" class="form-control" placeholder="Search…">
                            <span class="input-icon-addon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" /><path d="M21 21l-6 -6" /></svg>
                            </span>
                        </div> &nbsp; &nbsp;
                        <button class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#addnewadmin">Add Super Admin</button>

                    </div>

                        <div class="row g-5" id="adminCard">

                          {{-- <div id="administrators-card" class="col-md-6 col-lg-4 admincardeffects">
                            <div class="card">
                              <div class="card-body p-4 text-center">
                                <span class="avatar avatar-xl mb-3 rounded" style="background-image: url({{asset('./static/avatars/002m.jpg')}})"><img src="" alt=""> </span>
                                <h3 class="m-0 mb-1"><a href="#">Ghiza Ann Dojoles</a></h3>
                                <div class="text-muted">SSG Secretary</div>
                                <div class="mt-3">
                                  <span class="badge bg-green-lt">Administrator</span>
                                </div>
                              </div>
                              <div class="d-flex">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#editadmin" class="card-btn">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"/>
                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"/>
                                    <path d="M16 5l3 3"/>
                                  </svg>
                                  &nbsp; Edit
                                </a>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#demotemodal" class="card-btn">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-down-to-arc">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M12 3v12"/>
                                    <path d="M16 11l-4 4l-4 -4"/>
                                    <path d="M3 12a9 9 0 0 0 18 0"/>
                                  </svg>
                                  &nbsp; Demote
                                </a>
                              </div>
                            </div>
                          </div> --}}

                      </div>



                      </div>
            {{-- administrator --}}
                      <div class="tab-pane fade" id="administrators">
                      <div class="d-flex align-items-center justify-content-end mb-3">

                        <div class="input-icon">
                            <input type="text" value="" class="form-control" placeholder="Search…">
                            <span class="input-icon-addon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" /><path d="M21 21l-6 -6" /></svg>
                            </span>
                        </div> &nbsp; &nbsp;
                        <button class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#addnewadmin">Add Super Admin</button>

                    </div>

                        <div class="row g-5" id="adminCard">

                          {{-- <div id="administrators-card" class="col-md-6 col-lg-4 admincardeffects">
                            <div class="card">
                              <div class="card-body p-4 text-center">
                                <span class="avatar avatar-xl mb-3 rounded" style="background-image: url({{asset('./static/avatars/002m.jpg')}})"><img src="" alt=""> </span>
                                <h3 class="m-0 mb-1"><a href="#">Ghiza Ann Dojoles</a></h3>
                                <div class="text-muted">SSG Secretary</div>
                                <div class="mt-3">
                                  <span class="badge bg-green-lt">Administrator</span>
                                </div>
                              </div>
                              <div class="d-flex">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#editadmin" class="card-btn">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"/>
                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"/>
                                    <path d="M16 5l3 3"/>
                                  </svg>
                                  &nbsp; Edit
                                </a>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#demotemodal" class="card-btn">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-down-to-arc">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M12 3v12"/>
                                    <path d="M16 11l-4 4l-4 -4"/>
                                    <path d="M3 12a9 9 0 0 0 18 0"/>
                                  </svg>
                                  &nbsp; Demote
                                </a>
                              </div>
                            </div>
                          </div> --}}
                      </div>
                      </div>
      {{-- student administrator --}}
                      <div class="tab-pane fade" id="studentadmins">
                        <div class="d-flex align-items-center justify-content-end mb-3">
                          <div class="input-icon">
                              <input type="text" value="" class="form-control" placeholder="Search…">
                              <span class="input-icon-addon">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" /><path d="M21 21l-6 -6" /></svg>
                              </span>
                          </div> &nbsp; &nbsp;
                          <button class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#addstudentadmin" onclick="GetAllStudentData()">Add New Student Admin</button>
                      </div>

                        <div class="row g-5" id="adminCard2">
                          {{-- <div class="page-body">
                            <div class="container-xl d-flex flex-column justify-content-center">
                              <div class="empty">
                                <div class="empty-img"><img src="./static/illustrations/undraw_printing_invoices_5r4r.svg" height="128" alt="">
                                </div>
                                <p class="empty-title">Feature Coming Soon!</p>
                                <p class="empty-subtitle text-muted">
                                  This feature is not yet ready for the pre-oral defense stage. Stay tuned as it will be available for the final defense. See you there!
                                </p>
                                <div class="empty-action">
                                  <a href="./." class="btn btn-primary">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                                    Stay tuned!
                                  </a>
                                </div>
                              </div>
                            </div>
                          </div> --}}
                          {{-- <div id="administrators-card" class="col-md-6 col-lg-4 admincardeffects">
                            <div class="card">
                              <div class="card-body p-4 text-center">
                                <span class="avatar avatar-xl mb-3 rounded" style="background-image: url({{asset('./static/avatars/002m.jpg')}})"><img src="" alt=""> </span>
                                <h3 class="m-0 mb-1"><a href="#">Ghiza Ann Dojoles</a></h3>
                                <div class="text-muted">SSG Secretary</div>
                                <div class="mt-3">
                                  <span class="badge bg-green-lt">Administrator</span>
                                </div>
                              </div>
                              <div class="d-flex">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#editstudentadmin" class="card-btn">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"/>
                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"/>
                                    <path d="M16 5l3 3"/>
                                  </svg>
                                  &nbsp; Edit
                                </a>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#studentdemote" class="card-btn">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-down-to-arc">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M12 3v12"/>
                                    <path d="M16 11l-4 4l-4 -4"/>
                                    <path d="M3 12a9 9 0 0 0 18 0"/>
                                  </svg>
                                  &nbsp; Demote
                                </a>
                              </div>
                            </div>
                          </div> --}}

                        </div>
                      </div>

                      <div class="tab-pane fade" id="setsemestertab">
    @php
      $data = App\Models\SetSemester::first();
    @endphp
    <form action="{{ route('UpdateSemester') }}" method="POST">
        @csrf
        <div class="row">
            <!-- First Semester -->
            <div class="col-12 d-flex justify-content-center align-items-center mb-4">
                <h1>First Semester</h1>
            </div>
            <div class="col-6 mb-4 text-center justify-content-center align-items-center">
                <label for="first_start">Start</label>
                <input class="form-control" type="date" id="first_start" name="first_start" value="{{ $data->first_start ?? '' }}">
            </div>
            <div class="col-6 mb-4 text-center justify-content-center align-items-center">
                <label for="first_end">End</label>
                <input class="form-control" type="date" id="first_end" name="first_end" value="{{ $data->first_end ?? '' }}">
            </div>

            <!-- Second Semester -->
            <div class="col-12 d-flex justify-content-center align-items-center mb-4">
                <h1>Second Semester</h1>
            </div>
            <div class="col-6 mb-4 text-center justify-content-center align-items-center">
                <label for="second_start">Start</label>
                <input class="form-control" type="date" id="second_start" name="second_start" value="{{ $data->second_start ?? '' }}">
            </div>
            <div class="col-6 mb-4 text-center justify-content-center align-items-center">
                <label for="second_end">End</label>
                <input class="form-control" type="date" id="second_end" name="second_end" value="{{ $data->second_end ?? '' }}">
            </div>
        </div>
        <button type="submit" class="col-12 btn btn-primary">Update</button>
    </form>
</div>


                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>


        {{-- Modal --}}
        <div class="modal modal-blur fade" id="updatepassword" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Update Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="" method="POST" id="UpdateAdminPassForm">
                  @csrf

                <div class="mb-3">
                  <label class="form-label">Old Password</label>
                  <input type="Password" class="form-control" name="oldpass" id="oldpass" placeholder="Enter Old Password">
                </div>
                <div class="mb-3">
                <label class="form-label">New Password</label>
                <input type="Password" class="form-control" name="newpass" id="newpass" placeholder="Enter New Password">
            </div>
            <div class="mb-3">
                <label class="form-label">Repeat Password</label>
                <input type="Password" class="form-control" name="repass" id="repass" placeholder="Re-enter New Password">
            </div>
             </form>
              </div>
              <div class="modal-footer">
                <a href="#" class="btn btn-danger" data-bs-dismiss="modal">
                  Cancel
                </a>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="ChangeAdminPass()">
                  Update
                </button>
              </div>
            </div>
          </div>
        </div>


        {{-- Add Admin Modal --}}
                <div class="modal modal-blur fade" id="addnewadmin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header text-white" style="background-color: #3E8A34;">
                        <h5 class="modal-title" id="staticBackdropLabel">Add Super Admin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">

                        <form class="row g-3" id="addnewadministratorform" method="POST">@csrf
                        <div class="row g-2">
                          <div class="col-12">
                            <label for="adminname" class="form-label">Name</label>
                            <input type="text" class="form-control" name="administratorname" id="administratorname">
                          </div>
                          <div class="col-6">
                            <label for="adminuser" class="form-label">Username</label>
                              <input type="text" class="form-control" name="administratoruser" id="administratoruser">
                          </div>
                          <div class="col-6">
                            <label for="adminpass" class="form-label">Password</label>
                              <input type="password" class="form-control" name="administratorpass" id="administratorpass">
                          </div>

                        </div>

                        </form>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" onclick="AddAdministrator()">Save</button>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- Add Admin Modal --}}

                        {{-- Edit Admin Modal --}}
                        <div class="modal modal-blur fade" id="editadmin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header text-white" style="background-color: #3E8A34;">
                                <h5 class="modal-title" id="staticBackdropLabel">Add New Administrator</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">

                                <form class="row g-3" id="aditadministratorform" method="POST">@csrf
                                <div class="row g-2">
                                  <div class="col-12">
                                    <input type="hidden" name="administratorId" id="administratorId">
                                    <label for="adminname" class="form-label">Name</label>
                                    <input type="text" class="form-control" name="aditadministratorname" id="aditadministratorname">
                                  </div>
                                  <div class="col-6">
                                    <label for="adminuser" class="form-label">Username</label>
                                      <input type="text" class="form-control" name="aditadministratoruser" id="aditadministratoruser">
                                  </div>
                                  <div class="col-6">
                                    <label for="adminpass" class="form-label">Password</label>
                                      <input type="password" class="form-control" name="aditadministratorpass" id="aditadministratorpass">
                                  </div>
                                </div>

                                </form>

                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary" onclick="EditAdministratorInfo()">Save</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        {{-- Edit Admin Modal --}}

                        {{-- demote modal --}}
                        <div class="modal modal-blur fade" id="demotemodal" tabindex="-1" role="dialog" aria-hidden="true">
                          <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              <div class="modal-status bg-danger"></div>
                              <div class="modal-body text-center py-4">
                                <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" /><path d="M12 9v4" /><path d="M12 17h.01" /></svg>
                                <h3>Confirm Demotion</h3>
                                <div class="text-muted">Are you sure you want to demote this administrator and revoke their admin privileges?</div>
                                <form action="" method="POST" id="demoteadminform">@csrf
                                  <input type="hidden" name="demoteadminid" id="demoteadminid">
                                </form>
                              </div>
                              <div class="modal-footer">
                                <div class="w-100">
                                  <div class="row">
                                    <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                        Cancel
                                      </a></div>
                                    <div class="col"><a href="#" class="btn btn-danger w-100" data-bs-dismiss="modal" onclick="DemoteAdmin()">
                                        Yes, Demote
                                      </a></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="modal modal-blur fade" id="Enablemodal" tabindex="-1" role="dialog" aria-hidden="true">
                          <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              <div class="modal-status bg-danger"></div>
                              <div class="modal-body text-center py-4">
                                <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" /><path d="M12 9v4" /><path d="M12 17h.01" /></svg>
                                <h3>Confirm</h3>
                                <div class="text-muted">Are you sure you want to enable this administrator?</div>
                                <form action="" method="POST" id="enableadminform">@csrf
                                  <input type="hidden" name="demoteadminid" id="enableadminid">
                                </form>
                              </div>
                              <div class="modal-footer">
                                <div class="w-100">
                                  <div class="row">
                                    <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                        Cancel
                                      </a></div>
                                    <div class="col"><a href="#" class="btn btn-danger w-100" data-bs-dismiss="modal" onclick="enableAdmin()">
                                        Yes, Enable
                                      </a></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        {{-- demote modal --}}

                      {{-- upload profile pic --}}
                        <div class="modal modal-blur fade" id="uploadpic" tabindex="-1" role="dialog" aria-hidden="true">
                          <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-body">
                                <form action="" id="editadminpicform" method="POST">@csrf
                                <div class="modal-title">Upload Profile Picture</div>
                                <img src="" alt="">
                                <input type="file" class="form-control" name="editadminpic" id="editadminpic">
                              </div>
                              <div class="modal-footer">
                                <div class="w-100">
                                  <div class="row">
                                    <div class="col"><a href="#" class="btn btn-danger w-100" data-bs-dismiss="modal">
                                        Cancel
                                      </a></div>
                                    <div class="col"><button type="button" class="btn btn-success w-100" data-bs-dismiss="modal" onclick="ChangeAdminPic()">
                                        Save Changes
                                      </button></div>
                                  </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        {{-- upload profile pic --}}

        {{-- Add Admin Student Modal --}}
        <div class="modal modal-blur fade" id="addstudentadmin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header text-white" style="background-color: #3E8A34;">
                <h5 class="modal-title" id="staticBackdropLabel">Add Student Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">

                <div class="table-responsive">
                  <table class="table table-bordered table-hover" id="SelectStundentTable">
                    <thead>
                      <tr>
                        <th>Full Name</th>
                        <th>SCHOOL ID No.</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      {{-- <tr>
                        <td>Sample name</td>
                        <td>34545469</td>
                        <td>USG PRESIDENT</td>
                        <td>
                          <button class="btn btn-warning btn-sm">Select</button>
                        </td>
                      </tr> --}}
                    </tbody>
                  </table>
                </div>
                <hr>

                <form class="row g-3" id="addnewstudentadmin" method="POST">@csrf

                <div class="row g-2">
                  <div class="col-12">
                    <input type="hidden" name="studentadminid" id="studentadminid">
                    <label for="adminname" class="form-label">Full Name</label>
                    <input type="text" class="form-control" name="studentadminname" id="studentadminname" readonly>
                  </div>
                  <div class="col-6">
                    <label for="adminuser" class="form-label">School ID No.</label>
                      <input type="number" class="form-control" name="studentadminschoolid" id="studentadminschoolid" readonly>
                  </div>
                  <div class="col-6">
                    <label for="adminuser" class="form-label">USG Position</label>
                      <select name="studentposition" class="form-select" id="studentposition">
                        <option value="USG PRESIDENT">USG PRESIDENT</option>
                        <option value="USG SECRETARY">USG SECRETARY</option>
                        <option value="USG BUDGET&FINANCE">USG BUDGET&FINANCE</option>
                        <option value="USG SENATE PRESIDENT">USG SENATE PRESIDENT</option>
                        <option value="USG SENATE SECRETARY">USG SENATE SECRETARY</option>

                      </select>
                  </div>

                </div>

                </form>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="SetStudentAdmin()">Add as Admin</button>
              </div>
            </div>
          </div>
        </div>
        {{-- Add Student Modal --}}

        {{-- Edit Admin Student Modal --}}
                <div class="modal modal-blur fade" id="editstudentadmin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header text-white" style="background-color: #3E8A34;">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit Student Admin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form class="row g-3" id="editnewstudentadminform" method="POST">@csrf

                        <div class="row g-2">
                          <div class="col-12">
                            <input type="hidden" name="editstudentadminid" id="editstudentadminid">
                            <label for="editadminname" class="form-label">Full Name</label>
                            <input type="text" class="form-control" name="editstudentadminname" id="editstudentadminname" readonly>
                          </div>
                          <div class="col-6">
                            <label for="editadminuser" class="form-label">School ID No.</label>
                              <input type="number" class="form-control" name="editstudentadminschoolid" id="editstudentadminschoolid" readonly>
                          </div>
                          <div class="col-6">
                            <label for="editadminuser" class="form-label">USG Position</label>
                              <select name="editstudentposition" class="form-select" id="editstudentposition">
                                <option value="USG PRESIDENT">USG PRESIDENT</option>
                        <option value="USG SECRETARY">USG SECRETARY</option>
                        <option value="USG BUDGET&FINANCE">USG BUDGET&FINANCE</option>
                        <option value="USG SENATE PRESIDENT">USG SENATE PRESIDENT</option>
                        <option value="USG SENATE SECRETARY">USG SENATE SECRETARY</option>
                              </select>
                          </div>

                        </div>

                        </form>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" onclick="EditStudentAdminPosition()">Save Changes</button>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- Edit Student Modal --}}

                                {{-- demote modal --}}
                                <div class="modal modal-blur fade" id="studentdemote" tabindex="-1" role="dialog" aria-hidden="true">
                                  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      <div class="modal-status bg-danger"></div>
                                      <div class="modal-body text-center py-4">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" /><path d="M12 9v4" /><path d="M12 17h.01" /></svg>
                                        <h3>Confirm Demotion</h3>
                                        <div class="text-muted">Are you sure you want to demote this Student admin and revoke their admin privileges?</div>
                                        <form action="" method="POST" id="demotestudentadminform">@csrf
                                          <input type="hidden" name="demotestudentid" id="demotestudentid">
                                        </form>
                                      </div>
                                      <div class="modal-footer">
                                        <div class="w-100">
                                          <div class="row">
                                            <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                                Cancel
                                              </a></div>
                                            <div class="col"><a href="#" class="btn btn-danger w-100" data-bs-dismiss="modal" onclick="DemoteStudentAdmin()">
                                                Yes, Demote
                                              </a></div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                {{-- demote modal --}}

        {{-- Modal --}}

        @include('Admin.components.footer')

      </div>
    </div>

    @include('Admin.components.scripts')
    @include('Admin.components.functionscript')

  </body>
</html>
