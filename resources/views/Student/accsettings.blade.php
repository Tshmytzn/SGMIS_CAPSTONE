<!doctype html>

<html lang="en">

@include('Student.components.head', ['title' => 'Account Settings'])
@include('Student.components.header')

<body>
    <div class="page">

        @include('Student.components.nav', ['active' => 'Account Settings'])

        <div class="page-wrapper">
            <!-- Page header -->

            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="card">
                        <div class="row g-0">

                            <div class="col d-flex flex-column mx-4 my-4 ms-4">
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="my-account">
                                            <h2 class="mb-4">My Account </h2>
                                            <div class="col d-flex flex-column">
                                                <h3 class="card-title">Profile Details</h3>
                                                <div class="row align-items-center">
                                                    <div class="col-auto"><span class="avatar avatar-xl"><img
                                                                src="{{asset('./static/avatars/000m.jpg')}}" alt=""
                                                                id="adminpicture"></span>
                                                    </div>
                                                    <div class="col-auto">
                                                        <button type="button" data-bs-toggle="modal"
                                                            data-bs-target="#uploadpic" class="btn">
                                                            Change avatar
                                                        </button>
                                                    </div>
                                                </div>
                                                <h3 class="card-title mt-4">Student Profile</h3>

                                                <form action="" method="POST" id="">

                                                    <div class="row g-3">
                                                        <div class="col-md">
                                                            <div class="form-label">Student Name</div>

                                                            <input type="text" class="form-control" name="adminname"
                                                                id="adminname" value="Ghiza Ann Dojoles">
                                                        </div>
                                                        <div class="col-md">
                                                            <div class="form-label">Student ID</div>
                                                            <input type="text" class="form-control"
                                                                name="adminschoolid" id="adminschoolid" value="20216582">
                                                        </div>
                                                    </div>
                                                </form>
                                                <h3 class="card-title mt-4">Password</h3>
                                                <p class="card-subtitle">You can set a permanent password.</p>
                                                <div>
                                                    <a href="#" class="btn" data-bs-toggle="modal"
                                                        data-bs-target="#updatepassword">
                                                        Set new password
                                                    </a>
                                                </div>

                                                <div class="card-footer bg-transparent mt-3" style="margin-right: -2%">
                                                    <div class="btn-list justify-content-end">
                                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#savechanges">
                                                            Save Changes
                                                        </button>
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
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST" id="UpdateAdminPassForm">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">Old Password</label>
                                    <input type="Password" class="form-control" name="oldpass" id="oldpass"
                                        placeholder="Enter Old Password">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">New Password</label>
                                    <input type="Password" class="form-control" name="newpass" id="newpass"
                                        placeholder="Enter New Password">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Repeat Password</label>
                                    <input type="Password" class="form-control" name="repass" id="repass"
                                        placeholder="Re-enter New Password">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn btn-danger" data-bs-dismiss="modal">
                                Cancel
                            </a>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                                Update
                            </button>
                        </div>
                    </div>
                </div>
            </div>



            {{-- upload profile pic --}}
            <div class="modal modal-blur fade" id="uploadpic" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form action="" id="" method="POST">
                                <div class="modal-title">Upload Profile Picture</div>
                                <img src="" alt="">
                                <input type="file" class="form-control" name="editadminpic" id="editadminpic">
                        </div>
                        <div class="modal-footer">
                            <div class="w-100">
                                <div class="row">
                                    <div class="col"><a href="#" class="btn btn-danger w-100"
                                            data-bs-dismiss="modal">
                                            Cancel
                                        </a></div>
                                    <div class="col"><button type="button" class="btn btn-success w-100"
                                            data-bs-dismiss="modal">
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

            {{-- save changes modal --}}
            <div class="modal modal-blur fade" id="savechanges" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-status bg-warning"></div>
                    <div class="modal-body text-center py-4">
                      <!-- Download SVG icon from http://tabler-icons.io/i/circle-check -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-yellow icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M9 12l2 2l4 -4" /></svg>
                      <h3>Confirm Save Changes</h3>
                      <div class="text-muted">Are you sure you want to save the changes to your account?</div>
                    </div>
                    <div class="modal-footer">
                      <div class="w-100">
                        <div class="row">
                          <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                              Cancel
                            </a></div>
                          <div class="col"><a href="#" class="btn btn-warning w-100" id="saveChangesButton">
                              Save Changes
                            </a></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            {{-- save changes modal --}}

            {{-- Modal --}}

            @include('Admin.components.footer')

        </div>
    </div>

    @include('Admin.components.scripts')
    @include('Admin.components.functionscript')

</body>

</html>
