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
                                                        <button class="btn btn-primary">
                                                            Save Changes
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- administrator --}}
                                        <div class="tab-pane fade" id="administrators">
                                            <div class="d-flex align-items-center justify-content-end mb-3">

                                                <div class="input-icon">
                                                    <input type="text" value="" class="form-control"
                                                        placeholder="Search…">
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
                                                </div> &nbsp; &nbsp;
                                                <button class="btn btn-primary me-3" data-bs-toggle="modal"
                                                    data-bs-target="#addnewadmin">Add Super Admin</button>

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

            {{-- Modal --}}

            @include('Admin.components.footer')

        </div>
    </div>

    @include('Admin.components.scripts')
    @include('Admin.components.functionscript')

</body>

</html>
