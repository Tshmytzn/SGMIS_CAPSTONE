<!doctype html>

<html lang="en">
  
@include('Admin.components.header', ['title' => 'Settings'])

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
                        <a class="nav-link active" id="my-account-tab" data-bs-toggle="pill" href="#my-account">My Account</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="administrators-tab" data-bs-toggle="pill" href="#administrators">Administrators</a>
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
                            <h3 class="card-title">Profile Details</h3>
                            <div class="row align-items-center">
                              <div class="col-auto"><span class="avatar avatar-xl" style="background-image: url(./static/avatars/000m.jpg)"></span>
                              </div>
                              <div class="col-auto">
                                <label for="avatar-upload" class="btn">
                                    Change avatar
                                    <input type="file" id="avatar-upload" style="display: none;">
                                </label>
                            </div>
                            </div>
                            <h3 class="card-title mt-4">Student Profile</h3>
                            <div class="row g-3">
                              <div class="col-md">
                                <div class="form-label">Student Name</div>
                                <input type="text" class="form-control" value="SSG PRESS">
                              </div>
                              <div class="col-md">
                                <div class="form-label">Student ID</div>
                                <input type="text" class="form-control" value="20201422">
                              </div>
        
                            </div>
                            <h3 class="card-title mt-4">Password</h3>
                            <p class="card-subtitle">You can set a permanent password.</p>
                            <div>
                              <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#updatepassword"> 
                                Set new password
                              </a>
                            </div>
        
                          <div class="card-footer bg-transparent mt-3">
                            <div class="btn-list justify-content-end">
                              <a href="#" class="btn">
                                Cancel
                              </a>
                              <a href="#" class="btn btn-primary">
                                Submit
                              </a>
                            </div>
                          </div>
                        </div>                      
                      </div>
                      <div class="tab-pane fade" id="administrators">
                      <div class="d-flex align-items-center justify-content-end mb-3">

                        <div class="input-icon">
                            <input type="text" value="" class="form-control" placeholder="Search…">
                            <span class="input-icon-addon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" /><path d="M21 21l-6 -6" /></svg>
                            </span>
                        </div> &nbsp; &nbsp;
                        <button class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#addnewadmin">Add New Administrator</button>

                    </div>
                        
                        <div class="row g-5">
                        <div class="col-md-6 col-lg-4">
                          <div class="card">
                            <div class="card-body p-4 text-center">
                              <span class="avatar avatar-xl mb-3 rounded" style="background-image: url({{asset('./static/avatars/002m.jpg')}})"></span>
                              <h3 class="m-0 mb-1"><a href="#">Ghiza Ann Dojoles</a></h3>
                              <div class="text-muted">SSG Secretary</div>
                              <div class="mt-3">
                                <span class="badge bg-green-lt">Administrator</span>
                              </div>
                            </div>
                            <div class="d-flex">
                              <a href="#" data-bs-toggle="modal" data-bs-target="#editadmin" class="card-btn">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>                                
                                &nbsp; Edit
                              </a>
                               <a href="#" data-bs-toggle="modal" data-bs-target="#demotemodal" class="card-btn">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-down-to-arc"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3v12" /><path d="M16 11l-4 4l-4 -4" /><path d="M3 12a9 9 0 0 0 18 0" /></svg>
                                 &nbsp; Demote</a>
                            </div>
                          </div>
                        </div>

                      </div>
                        
                        
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
                <div class="mb-3">
                  <label class="form-label">Old Password</label>
                  <input type="Password" class="form-control" name="example-text-input" placeholder="Your report name">
                </div>
                <div class="mb-3">
                <label class="form-label">New Password</label>
                <input type="Password" class="form-control" name="example-text-input" placeholder="Your report name">
            </div>
            <div class="mb-3">
                <label class="form-label">Repeat Password</label>
                <input type="Password" class="form-control" name="example-text-input" placeholder="Your report name">
            </div>
              </div>
              <div class="modal-footer">
                <a href="#" class="btn btn-danger" data-bs-dismiss="modal">
                  Cancel
                </a>
                <a href="#" class="btn btn-primary" data-bs-dismiss="modal">
                  Update 
                </a>
              </div>
            </div>
          </div>
        </div>


        {{-- Add Admin Modal --}}
                <div class="modal modal-blur fade" id="addnewadmin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header text-white" style="background-color: #3E8A34;">
                        <h5 class="modal-title" id="staticBackdropLabel">Add New Administrator</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        
                        <form class="row g-3" id="addnewadmin" method="POST">
                        <div class="row g-2">
                          <div class="col-12">
                            <label for="adminname" class="form-label">Name</label>
                            <input type="text" class="form-control" name="adminname" id="editsectadminnameionid">         
                          </div>
                          <div class="col-6">
                            <label for="adminuser" class="form-label">Username</label>
                              <input type="text" class="form-control" name="adminuser" id="adminuser">         
                          </div>
                          <div class="col-6">
                            <label for="adminpass" class="form-label">Password</label>
                              <input type="password" class="form-control" name="adminpass" id="adminpass">         
                          </div>

                          <div class="row g-2">
                            <div class="col-6">
                                <label for="admintype" class="form-label">Admin Type</label>
                                <select class="form-select" id="admintype" name="admintype">
                                    <option>Select User Type</option>
                                    <option value="Master Admin">Master Admin</option>
                                    <option value="Basic Admin">Basic Admin</option>
                                </select>
                            </div>
                            <div class="col-6 align-self-end">
                              <label for="avatar-upload" class="btn btn-outline-green col-12">
                                Upload Profile
                                    <input type="file" id="avatar-upload" style="display: none;">
                                </label>
                            </div>
                        </div>
                        
                        </div>

                        </form>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" onclick="()">Save</button>
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
                                
                                <form class="row g-3" id="aditadmin" method="POST">
                                <div class="row g-2">
                                  <div class="col-12">
                                    <label for="adminname" class="form-label">Name</label>
                                    <input type="text" class="form-control" name="aditadminname" id="aditadminname">         
                                  </div>
                                  <div class="col-6">
                                    <label for="adminuser" class="form-label">Username</label>
                                      <input type="text" class="form-control" name="aditadminuser" id="aditadminuser">         
                                  </div>
                                  <div class="col-6">
                                    <label for="adminpass" class="form-label">Password</label>
                                      <input type="password" class="form-control" name="editadminpass" id="editadminpass">         
                                  </div>
        
                                  <div class="row g-2">
                                    <div class="col-6">
                                        <label for="admintype" class="form-label">Admin Type</label>
                                        <select class="form-select" id="editadmintype" name="editadmintype">
                                            <option>Select User Type</option>
                                            <option value="Master Admin">Master Admin</option>
                                            <option value="Basic Admin">Basic Admin</option>
                                        </select>
                                    </div>
                                    <div class="col-6 align-self-end">
                                      <label for="avatar-upload" class="btn btn-outline-green col-12">
                                        Update Profile
                                            <input type="file" id="avatar-upload" style="display: none;">
                                        </label>
                                    </div>
                                </div>
                                
                                </div>
        
                                </form>
        
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary" onclick="()">Save</button>
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
                              </div>
                              <div class="modal-footer">
                                <div class="w-100">
                                  <div class="row">
                                    <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                        Cancel
                                      </a></div>
                                    <div class="col"><a href="#" class="btn btn-danger w-100" data-bs-dismiss="modal">
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

  </body>
</html>